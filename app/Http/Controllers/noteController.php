<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class noteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notes = Auth::user()->notes()->with('category')->search(request('search'))->latest()->get()->map(function ($note) {
            $note->created_human = $note->created_at->diffForHumans();
            return $note;
        });

        return inertia('home', compact('notes'));
    }

    public function show(Note $note)
    {
        Gate::authorize('view', $note);
        $note->load('category');
        $note->created_human = $note->created_at->diffForHumans();
        return inertia('note/show', compact('note'));
    }

    public function create()
    {
        $categories = Auth::user()->categories()->get();
        
        return inertia('note/create', compact('categories'));
    }
    
    public function post()
    {
        $validated = request()->validate([
            'title' => ['required', 'string', 'min:5', 'max:128'],
            'content' => ['required', 'string', 'min:20', 'max:5000'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        Auth::user()->notes()->create($validated);

        return redirect()->route('home');
    }

    public function edit(Note $note)
    {
        Gate::authorize('view', $note);
        $categories = Auth::user()->categories()->get();
        return inertia('note/edit', compact('note', 'categories'));
    }

    public function update(Note $note) {
        Gate::authorize('update', $note);
        $validated = request()->validate([
            'title' => ['required', 'string', 'min:5', 'max:128'],
            'content' => ['required', 'string', 'min:20', 'max:5000'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $note->update($validated);

        return redirect()->route('home');
    }

    public function delete(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete();

        return redirect()->route('home');
    }
}
