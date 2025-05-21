<?php

namespace App\Http\Controllers;

use App\Models\CommunityPost;
use App\Models\CommunityComment;
use App\Models\CommunityLike;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $posts = CommunityPost::with(['user', 'game'])
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('community.index', compact('posts'));
    }

    public function show(CommunityPost $post)
    {
        $post->load(['user', 'game', 'comments.user']);
        $post->increment('views');

        return view('community.show', compact('post'));
    }

    public function create()
    {
        $games = Game::all();
        return view('community.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'type' => 'required|in:discussion,announcement,guide',
            'game_id' => 'nullable|exists:games,id',
        ]);

        $post = CommunityPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'game_id' => $validated['game_id'],
        ]);

        return redirect()->route('community.show', $post)
            ->with('success', 'Post created successfully!');
    }

    public function comment(Request $request, CommunityPost $post)
    {
        $validated = $request->validate([
            'content' => 'required|min:1',
            'parent_id' => 'nullable|exists:community_comments,id',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'],
        ]);

        return redirect()->route('community.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    public function like(Request $request, $type, $id)
    {
        $model = $type === 'post' ? CommunityPost::findOrFail($id) : CommunityComment::findOrFail($id);
        
        $like = CommunityLike::updateOrCreate(
            [
                'user_id' => Auth::id(),
                $type . '_id' => $id,
            ],
            [
                'type' => $request->input('type', 'like'),
            ]
        );

        return response()->json([
            'success' => true,
            'likes_count' => $model->likes()->count(),
        ]);
    }

    public function gameCommunity(Game $game)
    {
        $posts = CommunityPost::where('game_id', $game->id)
            ->with(['user'])
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('community.game', compact('game', 'posts'));
    }
} 