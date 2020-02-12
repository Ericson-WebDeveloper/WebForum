<?php


namespace App;

use App\Comment;
use Illuminate\Http\Request;

trait CommentableTrait
{
    public function AddComment($body)
    {
        
        $comments = new Comment();
        $comments->body = $body;
        $comments->user_id = auth()->user()->id;
        // pass the Thread $thread
        // its like $thread->comments()->save($comments);
        $this->comments()->save($comments);

        return $comments;
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }


    // public function AddReply($body)
    // {
        
    //     $comments = new Comment();
    //     $comments->body = $body;
    //     $comments->user_id = auth()->user()->id;
    //     // pass the Thread $thread
    //     // its like $thread->comments()->save($comments);
    //     $this->comments()->save($comments);
    // }
}