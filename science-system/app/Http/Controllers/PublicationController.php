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
            'type' => 'required'
        ]);

        Publication::create($request->only('title', 'authors', 'type'));

        return back();
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return back();
    }
}
