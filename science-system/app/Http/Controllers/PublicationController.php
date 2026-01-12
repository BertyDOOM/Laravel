<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Publication::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('authors', 'like', '%' . $request->search . '%');
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
        'title' => 'required|string|max:255',
        'authors' => 'required|string|max:255',
        'type' => 'required|in:journal,conference,book,report,poster',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->only('title', 'authors', 'type', 'theme');

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('publications', 'public');
        $data['image'] = $path;
    }

    Publication::create($data);

    return back();
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return back();
    }
}
