<?php

namespace App\Http\Controllers;

use App\Services\HashnodeService;

class PagesController extends Controller
{
    public function __construct(
        readonly HashnodeService $hashnodeService
    ) {}

    public function page(string $slug)
    {
        return view('pages.show', [
            'page' => $this->hashnodeService->getPage($slug),
        ]);
    }
}
