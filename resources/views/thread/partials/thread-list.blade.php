<div class="list-group mt-3">

    @forelse ($threads as $thread)
        {{-- <a href="{{ route('thread.show', [$thread->id])}}" class="list-group-item mb-2">
            <h4 class="list-group-item-heading">{{ $thread->subject }}</h4>
            <p class="list-group-item-text">{{ \Illuminate\Support\Str::limit($thread->thread, 100, '.....') }}</p>

   
                <a href="{{ route('user_profile', $thread->user->name ) }}">
                {{$thread->user->name}}
            </a> 
        </a> --}}

        <div class="card border-info mb-3">
            <div class="card-header"><h3>
                <a href="{{route('thread.show',$thread->id)}}">{{$thread->subject}}</a> </h3></div>
            <div class="card-body">
              <h4 class="card-title">{{\Illuminate\Support\Str::limit($thread->thread,100) }}</h4>
              <p class="card-text">Posted by <a href="{{route('user_profile',$thread->user->name)}}">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}</p>
            </div>
          </div>

        
    @empty
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">No Thread</h4>
        </a>
    @endforelse


</div>