<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {

        $galleries = auth()->user()->galleries;

        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->hasFile('image')) {
            auth()->user()->galleries()->create([
                'caption' => $request->input('caption'),
                'image' => $request->file('image')->store('galleries', 'public'),
            ]);

            return to_route('galleries.index');
        }

        return back();
 
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $path = $gallery->image;

        $this->validate($request, [
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $path = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update([
            'caption' => $request->input('caption'),
            'image' => $path,
        ]);

        return to_route('galleries.index');


    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->image);
        $gallery->delete();
        return back();
    }
}
