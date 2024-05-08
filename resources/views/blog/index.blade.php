@extends('layouts.app')
@section('title', 'Blog')
@section('content')

    {{ $followers }}

    @include('blog.posts', ['posts' => $posts])

@endsection
