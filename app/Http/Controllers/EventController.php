<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Models\Event;
use App\Models\Tag;

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

    public function store(CreateEventRequest $request)
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

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
