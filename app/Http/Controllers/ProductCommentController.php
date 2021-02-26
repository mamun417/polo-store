<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class ProductCommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'body' => 'required'
        ]);
        $data = [
            'body' => $request->body,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::id() ? Auth::id() : null,
        ];
        $product->comments()->create($data);

        return redirect()->back()->with('success', 'Comment successfully done');
    }


    public function likeUnlike(Request $request)
    {
        $request->validate([
            'comment_replay_id' => 'required'
        ]);

        if (!$request->ajax() || !Auth::check()) {
            return false;
        }

        $comment = Comment::find($request->comment_replay_id);


        if ($comment) {
            $data = [
                'user_id' => Auth::id(),
                'like' => 1
            ];
            $exist = $comment->likes()->where('user_id', Auth::id())->first();
            if (!$exist) {
                $comment->likes()->create($data);
                return 'add';
            } else {
                $exist->delete();
                return 'remove';
            }
        } else {
            return false;
        }
    }
}
