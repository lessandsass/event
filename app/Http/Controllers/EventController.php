<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    public function index() : View
    {

        $events = Event::with('country')->get();

        return view('events.index', compact('events'));
    }

    public function create() : View
    {
        $countries = Country::all();
        $tags = Tag::all();

        return view('events.create', compact('countries', 'tags'));
    }

    public function store(CreateEventRequest $request) : RedirectResponse
    {
        if ($request->hasFile('image')) {

            $data = $request->validated();
            $data['image'] = Storage::putFile('events', $request->file('image'));
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);

            $event = Event::create($data);
            $event->tags()->attach($request->tags);
            return to_route('events.index');

        } else {
            return back();
        }

    }

    public function edit(Event $event) : View
    {
        $countries = Country::all();
        $tags = Tag::all();

        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event) : RedirectResponse
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);
        return to_route('events.index');

    }

    public function destroy(string $id)
    {
        //
    }
}
