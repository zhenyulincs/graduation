@extends('layouts.backend')
@section('content')
<div class="card">
    <div class="card-header">Headings</div>
    <div class="card-body">
        <h2>{{$message->title}}</h2>
        <hr>
        <img class="img-avatar" src="img/avatars/6.jpg" alt="avatar">
    <strong>{{Auth::user()->where('id',$message->senderId)->first()->name}}</strong>
        <hr>
        <p>
            {!!$message->content!!}
        </p>
    </div>
</div>
@endsection