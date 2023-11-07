<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\HobbyService;
use Illuminate\Http\Request;
use App\Http\Requests\HobbyRequest;

class HobbyController extends Controller
{
    public function index()
    {
        return view('hobby');
    }

    public function create()
    {
        return view('hobbies.create');
    }

    public function store(HobbyRequest $request, HobbyService $service){
        $validated = $request->validated();
        $service->store($validated);
        return redirect()->route('hobby.index');
    }

}
