<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use App\Http\Requests\CommentRequest;
use App\Notifications\RepliedToThread;
use Symfony\Component\Console\Input\Input;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   

    public function AddComment(CommentRequest $request, Thread $thread)
    {
        // $comments = new Comment();
        // $comments->body = $request->body;
        // $comments->user_id = auth()->user()->id;

        // $thread->comments()->save($comments);

        $thread->AddComment($request->body);

        $thread->user->notify(new RepliedToThread($thread));

        return back()->withMessage('Comment Created');
    }

    public function AddReply(CommentRequest $request, Comment $comment)
    {
        // $comments = new Comment();
        // $comments->body = $request->body;
        // $comments->user_id = auth()->user()->id;

        // $comment->comments()->save($comments);

        $comment->AddComment($request->body);
        return back()->withMessage('Reply Created');
    }

    public function marksolution(Request $request)
    {
      
        $thread = Thread::find($request->thread);

        $thread->solution_comment = $request->comment;

        if($thread->save()){
            return response()->json(['status'=> 'success', 'message' => ' Set This As Mark The Solution']);
        }
        return response()->json(['status'=> 'erros', 'message' => 'Not Set This As Mark The Solution']);
        // return back()->withMessage('Mark The Solution');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        //
        if($comment->user_id !== auth()->user()->id)
        {
            abort(401);
        }
        
        $comment->update($request->all());

        return back()->withMessage('Comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id !== auth()->user()->id)
        {
            abort(401);
        }
        $comment->delete();
        return back()->withMessage('Comment Deleted');
    }
}
