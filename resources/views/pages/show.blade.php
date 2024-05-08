@extends('layouts.app')
@section('title', $page->title)

@section('meta')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>

<meta itemprop="name" content="{{ $page->title }}">
@if($page->seo->description)
<meta itemprop="description" content="{!! $page->seo->description !!}">
@endif
@if($page->ogMetaData->image)
<meta itemprop="image" content="{{ $page->ogMetaData->image }}">
@endif
@if($page->seo->description)
<meta name='description' content='{!! $page->seo->description !!}'>
@endif

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $page->title }}">
@if($page->seo->description)
<meta property="og:description" content="{!! $page->seo->description !!}">
@endif
@if($page->ogMetaData->image)
<meta property="og:image" content="{{ $page->ogMetaData->image }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $page->title }}">
@if($page->seo->description)
<meta name="twitter:description" content="{!! $page->seo->description !!}">
@endif
@if($page->ogMetaData->image)
<meta name="twitter:image" content="{{ $page->ogMetaData->image }}">
@endif

@endsection

@section('content')
<div class="container max-w-screen-lg pb-16 mx-auto">

    <div class="overflow-hidden mb-10 px-8 py-4 rounded-lg">

        <h1 class="text-white text-4xl text-center my-10">{{ $page->title }}</h1>

        <article class="mx-auto">

            <div class="dark:prose lg:prose-xl">
                {!! $page->content->html !!}
            </div>

        </article>

    </div>

</div>
@endsection
