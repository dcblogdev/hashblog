<?php

namespace App\Http\Controllers;

use App\Services\HashnodeService;

class BlogController extends Controller
{
    public function index(HashnodeService $hashnodeService)
    {
        return view('blog.index', [
            'posts' => $hashnodeService->getPosts()['edges'],
            'pageInfo' => $hashnodeService->getPosts()['pageInfo'],
        ]);
    }

    public function tag(HashnodeService $hashnodeService, string $tag)
    {
        return view('blog.tag', [
            'tag' => $tag,
            'posts' => $hashnodeService->getPostsByTag($tag)['edges'],
            'pageInfo' => $hashnodeService->getPosts()['pageInfo'],
        ]);
    }

    public function show(HashnodeService $hashnodeService, string $slug)
    {
        return view('blog.show', [
            'post' => $hashnodeService->getPost($slug),
        ]);
    }
}
