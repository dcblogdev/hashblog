<?php

use Illuminate\Support\Facades\Http;
use function Pest\Laravel\get;

test('can see blog page', function () {

    Http::fake(['https://gql.hashnode.com/' => Http::response([
            'data' => [
                'publication' => [
                    'posts' => [
                        'edges' => [
                            [
                                'node' => [
                                    'title' => 'My first post',
                                    'slug' => 'my-first-post',
                                    'brief' => 'This is my first post',
                                    'readTimeInMinutes' => 1,
                                    'publishedAt' => '2021-01-01',
                                    'views' => 1,
                                    'url' => 'https://dcblog.dev/my-first-post',
                                    'coverImage' => [
                                        'url' => 'https://dcblog.dev/my-first-post.jpg'
                                    ],
                                    'tags' => [
                                        [
                                            'name' => 'Laravel',
                                            'slug' => 'laravel'
                                        ]
                                    ],
                                    'author' => [
                                        'name' => 'John Doe',
                                        'username' => 'johndoe',
                                        'profilePicture' => 'https://dcblog.dev/johndoe.jpg'
                                    ]
                                ],
                            ], [
                                'node' => [
                                    'title' => 'My second post',
                                    'slug' => 'my-second-post',
                                    'brief' => 'This is my second post',
                                    'readTimeInMinutes' => 1,
                                    'publishedAt' => '2021-01-01',
                                    'views' => 1,
                                    'url' => 'https://dcblog.dev/my-second-post',
                                    'coverImage' => [
                                        'url' => 'https://dcblog.dev/my-second-post.jpg'
                                    ],
                                    'tags' => [
                                        [
                                            'name' => 'Laravel',
                                            'slug' => 'laravel'
                                        ]
                                    ],
                                    'author' => [
                                        'name' => 'John Doe',
                                        'username' => 'johndoe',
                                        'profilePicture' => 'https://dcblog.dev/johndoe.jpg'
                                    ]
                                ]
                            ]
                        ],
                        'pageInfo' => [
                            'endCursor' => '123',
                            'hasNextPage' => false
                        ]
                    ]
                ]
            ]
        ])
    ]);

    get('/')
        ->assertOk()
        ->assertViewHas('posts', function ($posts) {
            return count($posts) === 2;
        });
});

test('posts by tags', function () {

    Http::fake(['https://gql.hashnode.com/' => Http::response([
            'data' => [
                'publication' => [
                    'posts' => [
                        'edges' => [
                            [
                                'node' => [
                                    'title' => 'My first post',
                                    'slug' => 'my-first-post',
                                    'brief' => 'This is my first post',
                                    'readTimeInMinutes' => 1,
                                    'publishedAt' => '2021-01-01',
                                    'views' => 1,
                                    'url' => 'https://dcblog.dev/my-first-post',
                                    'coverImage' => [
                                        'url' => 'https://dcblog.dev/my-first-post.jpg'
                                    ],
                                    'tags' => [
                                        [
                                            'name' => 'Laravel',
                                            'slug' => 'laravel'
                                        ]
                                    ],
                                    'author' => [
                                        'name' => 'John Doe',
                                        'username' => 'johndoe',
                                        'profilePicture' => 'https://dcblog.dev/johndoe.jpg'
                                    ]
                                ]
                            ]
                        ],
                        'pageInfo' => [
                            'endCursor' => '123',
                            'hasNextPage' => false
                        ]
                    ]
                ]
            ]
        ])
    ]);

    get('tag/laravel')
        ->assertOk()
        ->assertViewHas('posts', function ($posts) {
            return count($posts) === 1;
        });
});