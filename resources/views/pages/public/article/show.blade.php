@extends('layouts.public')

@section('content')
    <h1>{{ $article->title }}</h1>
    <div>{{$article->body }}</div>
@endsection
