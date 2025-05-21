<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserGame;

class ReviewController extends Controller
{
    /**
     * Constructor to apply middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Store a newly created review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'content' => 'required|min:10',
            'is_recommended' => 'required|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Check if user already reviewed this game
        $existingReview = Review::where('user_id', Auth::id())
            ->where('game_id', $request->game_id)
            ->first();
        
        if ($existingReview) {
            return redirect()->back()->with('error', 'Bu oyun için zaten bir inceleme yazmışsınız. İncelemelerinizi profilinizden düzenleyebilirsiniz.');
        }
        
        // Handle image uploads
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'review_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/reviews', $imageName);
                $imageNames[] = $imageName;
            }
        }
        
        Review::create([
            'user_id' => Auth::id(),
            'game_id' => $request->game_id,
            'content' => $request->content,
            'is_recommended' => $request->is_recommended,
            'images' => $imageNames,
        ]);
        
        // Check badge eligibility
        Auth::user()->checkReviewBadges();
        
        return redirect()->back()->with('success', 'İncelemeniz başarıyla kaydedildi.');
    }
    
    /**
     * Update an existing review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|min:10',
            'is_recommended' => 'required|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $review = Review::findOrFail($id);
        
        // Check if the review belongs to the authenticated user
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Bu incelemeyi düzenleme izniniz yok.');
        }
        
        // Handle image uploads
        $imageNames = $review->images ?: [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'review_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/reviews', $imageName);
                $imageNames[] = $imageName;
            }
        }
        
        $review->update([
            'content' => $request->content,
            'is_recommended' => $request->is_recommended,
            'images' => $imageNames,
        ]);
        
        return redirect()->back()->with('success', 'İncelemeniz başarıyla güncellendi.');
    }
    
    /**
     * Remove a review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Check if the review belongs to the authenticated user
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Bu incelemeyi silme izniniz yok.');
        }
        
        // Delete associated images
        if (!empty($review->images)) {
            foreach ($review->images as $image) {
                Storage::delete('public/reviews/' . $image);
            }
        }
        
        $review->delete();
        
        return redirect()->back()->with('success', 'İncelemeniz başarıyla silindi.');
    }
    
    /**
     * Mark a review as helpful.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markHelpful($id)
    {
        $review = Review::findOrFail($id);
        
        // Don't allow users to mark their own reviews as helpful
        if ($review->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'Kendi incelemenizi yararlı olarak işaretleyemezsiniz.');
        }
        
        $review->increment('helpful_count');
        
        return redirect()->back()->with('success', 'İncelemeyi yararlı olarak işaretlediniz.');
    }

    /**
     * Show the form for creating a new review.
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function create($gameId)
    {
        $game = Game::findOrFail($gameId);
        
        // Check if user owns the game
        $hasGame = false;
        if (Auth::check()) {
            $hasGame = UserGame::where('user_id', Auth::id())
                ->where('game_id', $game->id)
                ->exists();
        }
        
        // Redirect if the user doesn't own the game
        if (!$hasGame) {
            return redirect()->route('games.detail', $game->id)
                ->with('error', 'İnceleme yazmak için oyuna sahip olmalısınız.');
        }
        
        return view('reviews.create', compact('game'));
    }
}
