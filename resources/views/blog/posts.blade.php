<div class="grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
@foreach($posts as $post)

    @php $post = $post->node; @endphp

    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden mb-10">

        @if(!empty($post->coverImage->url))
            <div class="flex-shrink-0">
                <a href="{{ url($post->slug) }}" class="block">
                    <img class="w-full object-cover rounded-t-lg" src="{{ $post->coverImage->url }}" alt="">
                </a>
            </div>
        @endif

        <div class="flex-1 bg-indigo-800 p-6 flex flex-col justify-between">
            <div class="flex-1">
                <p class="text-sm leading-5 font-medium text-primary mb-0">
                    @foreach($post->tags as $tag)
                        <a href="{{ url('tag/'.strtolower($tag->slug)) }}">
                            {{ $tag->name }}
                            @if (!$loop->last) | @endif
                        </a>
                    @endforeach
                </p>
                <a href="{{ url($post->slug) }}" class="block">
                    <h2 class="mt-2 text-xl leading-7 font-semibold">
                        {{ $post->title }}
                    </h2>

                    <div class="mt-3 text-base leading-6 text-white">
                        {!! Str::limit($post->brief, 100) !!}
                    </div>
                </a>
            </div>
            <div class="mt-6 flex items-center">
                <div class="flex-shrink-0">
                    @if (!empty($post->author->profilePicture))
                        <a href='{{ 'https://hashnode.com/@'.$post->author->username }}'>
                            <img class="w-10 h-10 pr-1 rounded-full" src="{{ $post->author->profilePicture }}" alt="{{ $post->author->name }}">
                        </a>
                    @endif
                </div>
                <div class="ml-3">
                    <p class="text-sm mb-0 font-medium text-primary">
                        <a href="{{ 'https://hashnode.com/@'.$post->author->username }}" class="hover:underline">{{ $post->author->name }}</a>
                    </p>
                    <div class="flex text-sm text-gray-200 dark:text-gray-200">
                        <p>
                            {{ $post->readTimeInMinutes}} min read -
                            {{ $post->views }} views -
                            <time datetime="{{ $post->publishedAt }}">{{ date('jS M, Y', strtotime($post->publishedAt)) }}</time>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

@if($pageInfo->hasNextPage)
    <div class="flex justify-center">
        <a class="bg-indigo-600 text-white px-2 py-2.5 mb-10 rounded-md" href="{{ url()->current().'?next='.$pageInfo->endCursor }}">Next Page</a>
    </div>
@endif
