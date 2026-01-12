<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Publication::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('authors', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $publications = $query->latest()->get();

        return view('publications.index', compact('publications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(Publication::TYPES)),
            'theme'   => 'nullable|in:' . implode(',', array_keys(Publication::THEMES)),
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'authors', 'type', 'theme');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publications', 'public');
        }

        Publication::create($data);

        return back();
    }

    public function edit(Publication $publication)
    {
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(Publication::TYPES)),
            'theme'   => 'nullable|in:' . implode(',', array_keys(Publication::THEMES)),
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'authors', 'type', 'theme');

        if ($request->hasFile('image')) {
            if ($publication->image) {
                Storage::disk('public')->delete($publication->image);
            }

            $data['image'] = $request->file('image')->store('publications', 'public');
        }

        $publication->update($data);

        return redirect()->route('publications.index');
    }

    public function destroy(Publication $publication)
    {
        if ($publication->image) {
            Storage::disk('public')->delete($publication->image);
        }

        $publication->delete();

        return back();
    }
}
