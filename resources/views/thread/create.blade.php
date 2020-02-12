@extends('layouts.front')

@section('heading',"Create Thread")

@section('content')

@include('thread.partials.success')
        <form action="{{ url('thread/store') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="subject">Thread Subject</label> 
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Input Subject"
                           value="{{old('subject')}}">
                <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : '' }}</span>
              </div>
             
              <div class="form-group">
                <label for="type">Thread Tags</label>
                <select class="form-control" multiple name="tag[]" id="tags">
                  <option value="discussion">discussion</option>
                  <option value="debate">debate</option>
                  <option value="comment">comment</option>
                </select>
                <span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
              </div>
         
              <div class="form-group">
                <label for="thread">Thread</label>
                <textarea class="form-control" name="thread" id="thread" placeholder="Input thread"
                    > {{ old('thread') }}</textarea>
                    <span class="text-danger">{{ $errors->has('thread') ? $errors->first('thread') : '' }}</span>
              </div>

              <div class="form-group">
                {!! NoCaptcha::display() !!}
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
@endsection


@section('js')
    <script>
       
        $(function () {
            $('#tags').selectize();
        })
    </script>
@endsection