<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $level = 0;
        if ($request->parent_id) {
            $parentComment = Comment::findOrFail($request->parent_id);
            $level = $parentComment->level + 1;
        }

        $comment = $article->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'level' => $level
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'comment' => $comment->load(['user', 'replies.user'])
            ]);
        }

        return back()->with('success', 'Comment posted successfully!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Comment deleted successfully']);
        }

        return back()->with('success', 'Comment deleted successfully!');
    }
}
