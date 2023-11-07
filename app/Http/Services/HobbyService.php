<?php

namespace App\Http\Services;

use App\Models\Hobby;

class HobbyService
{
    public function store($validated)
    {
        $hobby = Hobby::create($validated);
        return $hobby;
    }
}
