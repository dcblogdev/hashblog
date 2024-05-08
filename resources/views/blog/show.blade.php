@extends('layouts.app')
@section('title', $post->title)

@section('meta')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>

<meta itemprop="name" content="{{ $post->seo->title }}">
@if($post->seo->description)
<meta itemprop="description" content="{!! $post->seo->description !!}">
@endif
@if($post->ogMetaData->image)
<meta itemprop="image" content="{{ $post->ogMetaData->image }}">
@endif
@if($post->seo->description)
<meta name='description' content='{!! $post->seo->description !!}'>
@endif

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $post->seo->title }}">
@if($post->seo->description)
<meta property="og:description" content="{!! $post->seo->description !!}">
@endif
@if($post->ogMetaData->image)
<meta property="og:image" content="{{ $post->ogMetaData->image }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $post->seo->title }}">
@if($post->seo->description)
<meta name="twitter:description" content="{!! $post->seo->description !!}">
@endif
@if($post->ogMetaData->image)
<meta name="twitter:image" content="{{ $post->ogMetaData->image }}">
@endif

@endsection

@section('content')

<div class="container max-w-screen-lg pb-16 mx-auto">

    <div class="overflow-hidden mb-10 px-8 py-4 rounded-lg">

        @if(!empty($post->coverImage->url))
            <div class="flex-shrink-0">
                <a href="{{ url($post->slug) }}" class="block">
                    <img class="w-full object-cover rounded-t-lg" src="{{ $post->coverImage->url }}" alt="">
                </a>
            </div>
        @endif

        <h1 class="text-white text-4xl text-center mt-10">{{ $post->title }}</h1>

        <p class="text-sm leading-5 font-medium text-primary mb-0">
            @foreach($post->tags as $tag)
                <a href="{{ url('tag/'.strtolower($tag->slug)) }}">
                    {{ $tag->name }}
                    @if (!$loop->last) | @endif
                </a>
            @endforeach
        </p>

        <div class="flex items-center mt-6 mb-6">

            @if(!empty($post->author->profilePicture))
                <div class="flex-shrink-0">
                    <a href='{{ 'https://hashnode.com/@'.$post->author->username }}'>
                        <img class="w-10 h-10 pr-1 rounded-full" src="{{ $post->author->profilePicture }}" alt="{{ $post->author->name }}">
                    </a>
                </div>
            @endif

            <div class="ml-3">
                <p class="text-sm mb-0 font-medium text-primary">
                    <a href="{{ 'https://hashnode.com/@'.$post->author->username }}" class="hover:underline">{{ $post->author->name }}</a>
                </p>
                <div class="flex text-sm leading-5 text-gray-500 dark:text-gray-200">
                    <p>{{ $post->readTimeInMinutes}} min read - {{ date('jS M, Y', strtotime($post->publishedAt)) }}</p>
                </div>
            </div>

        </div>

        <article class="mx-auto">

            <p class="text-sm leading-5 font-medium text-primary mb-0">
                @foreach($post->tags as $tag)
                    <a href="{{ url('tag/'.strtolower($tag->name)) }}">
                        {{ $tag->name }}
                        @if (!$loop->last) | @endif
                    </a>
                @endforeach
            </p>

            <div class="dark:prose lg:prose-xl">
            {!! $post->content->html !!}
            </div>

            <a href="https://hashnode.com/discussions/post/{{ $post->id }}" target="_Blank" rel="noreferrer" class="flex w-full flex-row flex-wrap items-center gap-5 rounded-2xl px-4 py-4 mt-5 text-gray-700 shadow bg-gray-300 dark:text-gray-700 md:gap-2 md:px-10 md:shadow-md justify-between">
                <div class="flex flex-row items-center gap-2 font-bold">
                    <span>{{ $post->responseCount }} comments</span>
                    <svg fill="none" class="w-4 h-4 stroke-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12v6a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h6m4 0h5m0 0v5m0-5-8 8"></path></svg>
                </div>
                <div class="flex flex-row items-center gap-2">
                    <span>Add a comment</span>
                    <svg fill="none" class="w-5 h-5 stroke-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.51 11.636h4.323a2.864 2.864 0 0 1 2.864 2.864m-5.376-.846-2.018-2.018 2.02-2.02m-4.687-3.73a9 9 0 1 1 2.806 14.633 1.062 1.062 0 0 0-.594-.077l-4.158.694a.5.5 0 0 1-.576-.576l.697-4.15a1.063 1.063 0 0 0-.077-.595 9.003 9.003 0 0 1 1.902-9.929Z"></path></svg>
                </div>
            </a>

        </article>

    </div>

</div>

@endsection
