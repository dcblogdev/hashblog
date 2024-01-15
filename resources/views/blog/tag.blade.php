@extends('layouts.app')
@section('title', "Post by Tag: $tag")
@section('content')

    <p class="py-5 text-xl">Posts by tag: {{ $tag }}</p>

    @include('blog.posts', ['posts' => $posts])

@endsection