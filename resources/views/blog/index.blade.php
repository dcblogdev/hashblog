@extends('layouts.app')
@section('title', 'Blog')
@section('content')

    @include('blog.posts', ['posts' => $posts])

@endsection