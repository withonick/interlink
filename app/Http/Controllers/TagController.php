<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(TagRequest $request, TagService $tagService)
    {
        $validatedData = $request->validated();
        $tagService->addTag($validatedData);

        return back();
    }
}
