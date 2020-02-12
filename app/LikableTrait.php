<?php


namespace App;

use Illuminate\Http\Request;

trait LikableTrait
{
   
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }


    public function likeit()
    {
        $like = new Like();
        $like->user_id = auth()->user()->id;

        $this->likes()->save($like);

        return response()->json(['status'=>'success','message'=>'liked']);
    }

    public function unlikeIt()
    {
        $this->likes()->where('user_id',auth()->id())->delete();
    }

    public function isLiked()
    {
        return !!$this->likes()->where('user_id',auth()->id())->count();
    }

}