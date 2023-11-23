<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show(Event $event){
        return view('events.show', compact('event'));
    }

    public function create(){
        return view('events.create');
    }

    public function store(EventRequest $request){
        $event = Event::create($request->validated());

        if ($request->has('image')){
            $event->addMediaFromRequest('image')->toMediaCollection('event_avatars');
        }

        return redirect()->route('events.index');
    }
}
