@extends('layouts.front')

@section('heading',"Thread Details")

@section('content')
@include('thread.partials.success')

<div class="jumbotron">

    {{-- <h4>{{$thread->subject}}</h4> --}}
    {{-- <hr> --}}

    <blockquote class="blockquote">
        <h4 class="mb-0">{{$thread->subject}}</h4>
        <footer class="blockquote-footer"> {!! \Michelf\Markdown::defaultTransform($thread->thread)  !!}</footer>
      </blockquote>

    {{-- <div class="thread-details">
        {!! \Michelf\Markdown::defaultTransform($thread->thread)  !!}
    </div> --}}
    {{-- <br> --}}

    @if (Auth::check())
        @can('update', $thread)
            <div class="actions">
                <a href="{{ route('thread.edit', [$thread->id]) }} " class="btn btn-info btn-sm">Edit</a>
                <form action="{{route('thread.destroy',[$thread->id])}}" method="POST" class="inline-it">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                </form>
            </div>
        @endcan
    @endif
</div>

    <div class="comment-list">
        @foreach ($thread->comments as $comment)
        <button class="btn btn-sm btn-dark" onclick="togglereply('{{$comment->id}}')">Reply</button>
            <h4>{{ $comment->body }}</h4>
            <p>{{ $comment->user->name}}</p>
            @if (Auth::check()) 
            <div class="actions">        
                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="#{{ 'comment' . $comment->id}}">Edit</a>
                    <div class="modal" id="{{ 'comment' . $comment->id }}">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Comment Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('comment.update', [$comment->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="body">Comment</label>
                                            <input type="text"  class="form-control" name="body" id="body" placeholder="Comment" value="{{ $comment->body }}">
                                            <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : ''}}</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
        
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                <form action="{{ route('comment.destroy', [$comment->id]) }}" method="POST" class="inline-it">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                </form>

            

                {{-- @if (auth()->check() && auth()->user()->id == $thread->user_id) --}}
                  @can('update', $thread)
                    <button class="btn btn-sm btn-info marksolutionbtn" thread="{{$thread->id }}" 
                        comment="{{$comment->id}}"
                    > {{ $thread->solution_comment == $comment->id ? 'Best Solution' : 'Mark As Solution'}} </button>
                  @endcan
                {{-- @endif --}}
                <button class="btn btn-sm {{ $comment->isLiked() ? 'btn-success' : 'btn-secondary'}}">
                <span class="glyphicon glyphicon-heart likable" comment="{{$comment->id}}"> {{ count($comment->likes) }} Like</span></button>
            </div>
            
            @endif
            
         
            {{-- reply --}}
            @foreach ($comment->comments as $reply)
                <div class="small well text-info reply-list mt-2 ml-5">
                    {{-- <p>{{ $reply->body }}</p>
                    <small>{{ $reply->user->name }}</small> --}}
                    <blockquote class="blockquote">
                        <p class="mb-0">{{ $reply->body }}</p>
                        <footer class="blockquote-footer">{{ $reply->user->name }}</footer>
                      </blockquote>
                    @if (Auth::check()) 
                        <div class="actions ml-5">        
                                <a class="btn btn-primary btn-sm" data-toggle="modal" href="#{{ 'reply' . $reply->id}}">Edit</a>
                                <div class="modal" id="{{ 'reply' . $reply->id }}">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title">Reply Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('comment.update', [$reply->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <div class="form-group">
                                                        <label for="body">Reply</label>
                                                        <input type="text"  class="form-control" name="body" id="body" placeholder="Reply" value="{{ $reply->body }}">
                                                        <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : ''}}</span>
                                                    </div>
                                                    <button type="submit" class="btn bnt-sm btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            {{-- <div class="modal-footer">
                    
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div> --}}
                                        </div>
                                        </div>
                                    </div>

                            <form action="{{ route('comment.destroy', [$reply->id]) }}" method="POST" class="inline-it">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                            </form>

                        </div>
                        @endif
                </div>
            @endforeach
            <div class="reply-form-{{$comment->id}} ml-5 d-none">
                <form action="{{ route('thread.reply.add', [$comment->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="body">Reply</label>
                        <input type="text"  class="form-control" name="body" id="body" placeholder="Reply" value="{{ old('body')}}">
                        <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : ''}}</span>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                </form>
            </div>
            <hr>

        @endforeach
    </div>

    <div class="comment-form">
        <form action="{{ route('thread.comment.add', [$thread->id]) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="body">Comment</label>
                <input type="text"  class="form-control" name="body" id="body" placeholder="Comment" value="{{ old('body')}}">
                <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : ''}}</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection

@section('js')
    <script>
        function togglereply(id)
        {
            alert(id);
             $('.reply-form-'+id).toggleClass('d-none');
        }

        function MarkAsSolution(thread, comment) { 

            // let csrftoken =  $('meta[name="csrf-token"]').attr('content');
            // $.post('{{ route('mark.solution') }}', {thread:thread,  comment:comment, _token:Laravel.csrfToken}, function(data){
            //     console.log('success');
            // });


            $.ajax({
            data: {threadid:thread,  comment:comment},
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('mark.solution') }}',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log( data );
                },
                error: function( data ) {
                console.log( data );
                }
            }); 
         }

         $(document).ready( function () {
                $(".likable").on('click', function() {
                    let comment = $(this).attr("comment");
                        axios.post(`/thread/like/comment`, {
                            comment:comment
                        })
                        .then(function (response) {
                            location.reload();
                        })
                        .catch(function (error) {
                             location.reload();
                        });
                });

                $(".marksolutionbtn").on('click', function() {
                    let thread = $(this).attr("thread");
                    let comment = $(this).attr("comment");
                    
                        axios.post(`/thread/mark/solution`, {
                            thread: thread, comment:comment
                        })
                        .then(function (response) {
                            location.reload();
                        })
                        .catch(function (error) {
                             location.reload();
                        });

                });
            });
    </script>
@endsection