<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function likeit(Request $request)
    {
        
        $comment = Comment::find($request->comment);

        // $comment->likeit();

        if(!$comment->isLiked()){
            $comment->likeIt();
            return response()->json(['status'=>'success','message'=>'liked']);

        }else{
            $comment->unlikeIt();
            return response()->json(['status'=>'success','message'=>'unliked']);

        }
    }
}
