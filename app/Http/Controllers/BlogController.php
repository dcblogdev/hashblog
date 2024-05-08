<?php

namespace App\Http\Controllers;

use App\Services\HashnodeService;

class BlogController extends Controller
{
    public function __construct(
        readonly HashnodeService $hashnodeService
    ) {}

    public function index()
    {
        $posts = $this->hashnodeService->getPosts();

        return view('blog.index', [
            'followers' => $posts->author->followersCount,
            'posts' => $posts->posts->edges,
            'pageInfo' => $posts->posts->pageInfo,
        ]);
    }

    public function tag(string $tag)
    {
        return view('blog.tag', [
            'tag' => $tag,
            'posts' => $this->hashnodeService->getPostsByTag($tag)->edges,
            'pageInfo' => $this->hashnodeService->getPosts()->posts->pageInfo,
        ]);
    }

    public function show(string $slug)
    {
        return view('blog.show', [
            'post' => $this->hashnodeService->getPost($slug),
        ]);
    }
}
