@extends('layouts.app')
@section('title', $post['title'])

@section('meta')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>
@endsection

@section('content')

<div class="container max-w-screen-lg pb-16 mx-auto">

    <div class="overflow-hidden mb-10 px-8 py-4 rounded-lg">

        @if(!empty($post['coverImage']['url']))
            <div class="flex-shrink-0">
                <a href="{{ url($post['slug']) }}" class="block">
                    <img class="w-full object-cover rounded-t-lg" src="{{ $post['coverImage']['url'] }}" alt="">
                </a>
            </div>
        @endif

        <h1 class="text-white text-4xl text-center mt-10">{{ $post['title'] }}</h1>

        <p class="text-sm leading-5 font-medium text-primary mb-0">
            @foreach($post['tags'] as $tag)
                <a href="{{ url('tag/'.strtolower($tag['slug'])) }}">
                    {{ $tag['name'] }}
                    @if (!$loop->last) | @endif
                </a>
            @endforeach
        </p>

        <div class="flex items-center mt-6 mb-6">

            @if(!empty($post['author']['profilePicture']))
                <div class="flex-shrink-0">
                    <a href='{{ 'https://hashnode.com/@'.$post['author']['username'] }}'>
                        <img class="w-10 h-10 pr-1 rounded-full" src="{{ $post['author']['profilePicture'] }}" alt="{{ $post['author']['name'] }}">
                    </a>
                </div>
            @endif

            <div class="ml-3">
                <p class="text-sm mb-0 font-medium text-primary">
                    <a href="{{ 'https://hashnode.com/@'.$post['author']['username'] }}" class="hover:underline">{{ $post['author']['name'] }}</a>
                </p>
                <div class="flex text-sm leading-5 text-gray-500 dark:text-gray-200">
                    <p>{{ $post['readTimeInMinutes']}} min read - {{ date('jS M, Y', strtotime($post['publishedAt'])) }}</p>
                </div>
            </div>

        </div>

        <article class="mx-auto">

            <p class="text-sm leading-5 font-medium text-primary mb-0">
                @foreach($post['tags'] as $tag)
                    <a href="{{ url('tag/'.strtolower($tag['name'])) }}">
                        {{ $tag['name'] }}
                        @if (!$loop->last) | @endif
                    </a>
                @endforeach
            </p>

            <div class="dark:prose lg:prose-xl">
            {!! $post['content']['html'] !!}
            </div>

        </article>

    </div>

</div>

@endsection