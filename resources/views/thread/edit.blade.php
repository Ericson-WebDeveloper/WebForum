@extends('layouts.front')

@section('heading',"Edit Thread")

@section('content')

        <form action="{{ route('thread.update', [$thread->id]) }}" method="post">
              {{ csrf_field() }}
              {{method_field('put')}}
              <div class="form-group">
                <label for="subject">Thread Subject</label> 
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Input Subject"
                           value="{{ $thread->subject }}">
                <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : ''}}</span>
              </div>
             
              <div class="form-group">
                <label for="type">Thread Type</label>
                <select class="form-control" id="type" name="type">
    
                  <option value="{{ $thread->type }}"> {{ $thread->type }}</option>
                  <option value="discussion">discussion</option>
                  <option value="debate">debate</option>
                  <option value="comment">comment</option>
                </select>
                <span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : ''}}</span>
              </div>
         
              <div class="form-group">
                <label for="thread">Thread</label>
                <textarea class="form-control" name="thread" id="thread" placeholder="Input thread"
                    > {{$thread->thread }}</textarea>
                    <span class="text-danger">{{ $errors->has('thread') ? $errors->first('thread') : ''}}</span>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
@endsection