@extends('layouts.front')


@section('content')

@include('thread.partials.success')
<h3>Threads</h3>

    @include('thread.partials.thread-list')
@endsection