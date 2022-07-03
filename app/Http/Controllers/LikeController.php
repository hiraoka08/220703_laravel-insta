<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    public function store($post_id){
        // set the user_id
        $this->like->user_id = Auth::user()->id;
        // set the post_id
        $this->like->post_id = $post_id ;
        // save
        $this->like->save();

        // redirect back
        return redirect()->back();
    }

    public function destroy($post_id){
        $this->like->where('post_id', $post_id)->where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }
}
