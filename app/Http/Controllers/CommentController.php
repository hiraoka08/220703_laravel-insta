<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id){
        $request->validate([
            'comment_body' . $post_id => 'required|max:150'
        ]);

        $this->comment->user_id = Auth::user()->id;
        // Auth::user() - the user who is logged in
        $this->comment->post_id = $post_id;
        $this->comment->body    = $request->input('comment_body' . $post_id);
        // $request holds the data from the form
        $this->comment->save();

        return redirect()->back();
    }

    public function deleteComment($id){
        $comment = $this->comment->findOrFail($id);
        $comment->delete();

        return redirect()->back();
    }
}
