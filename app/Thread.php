<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //
    use CommentableTrait, LikableTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // nasa trait na ito CommentableTrait
    // public function comments()
    // {
    //     return $this->morphMany(Comment::class, 'commentable')->latest();
    // }

    // public function likable()
    // {
    //     return $this->morphTo();
    // }

}
