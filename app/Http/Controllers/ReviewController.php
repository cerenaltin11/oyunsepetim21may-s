<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        // Check if user already reviewed this game
        $existingReview = Review::where('user_id', Auth::id())
            ->where('game_id', $request->game_id)
            ->first();
            
        if ($existingReview) {
            return redirect()->back()->with('error', 'Bu oyun için zaten bir değerlendirme yapmışsınız.');
        }
        
        Review::create([
            'user_id' => Auth::id(),
            'game_id' => $request->game_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Değerlendirmeniz başarıyla kaydedildi.');
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        $review = Review::findOrFail($id);
        
        // Check if the review belongs to the authenticated user
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Bu değerlendirmeyi düzenleme yetkiniz yok.');
        }
        
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Değerlendirmeniz başarıyla güncellendi.');
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
            return redirect()->back()->with('error', 'Bu değerlendirmeyi silme yetkiniz yok.');
        }
        
        $review->delete();
        
        return redirect()->back()->with('success', 'Değerlendirmeniz silindi.');
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
            return redirect()->back()->with('error', 'Kendi değerlendirmenizi yararlı olarak işaretleyemezsiniz.');
        }
        
        $review->increment('helpful_count');
        
        return redirect()->back()->with('success', 'Değerlendirme yararlı olarak işaretlendi.');
    }
}
