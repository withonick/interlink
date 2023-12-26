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
            $event->addMediaFromRequest('image')
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])
                ->toMediaCollection('event_avatars');
        }

        return redirect()->route('events.index');
    }

    public function storeImages(Request $request, Event $event){
        foreach ($request->images as $image){
            $event->addMedia($image)
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])
                ->toMediaCollection('event_gallery');
        }

        return redirect()->route('events.show', ['event' => $event]);
    }

    public function deleteImage(Event $event, $image){
        $image = $event->getMedia('event_gallery')->where('id', $image)->first();
        $event->deleteMedia($image);
        return back();
    }

    public function join(Event $event){
        if ($event->users()->where('user_id', auth()->id())->exists()){
            $event->users()->detach(auth()->id());
        }else{
            $event->users()->attach(auth()->id());
        }
        return back();
    }

}
