<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class categroyController extends Controller
{
    public function index() {
        $user = Auth::user();
        $categories = $user->categories()->get();
        return inertia('category/index', compact('categories'));
    }

    public function create() {
        return inertia('category/create');
    }

    public function post() {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:25', 'min:3']
        ]);

        Auth::user()->categories()->create($validated);

        return redirect()->route('category.index');
    }

    public function edit(Category $category) {
        Gate::authorize('view', $category);
        return inertia('category/edit', compact('category'));
    }

    public function update(Category $category) {
        Gate::authorize('update', $category);
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:25', 'min:3']
        ]);

        $category->name = $validated['name'];

        if ($category->isDirty('name')) {
            $category->update($validated);
            return redirect()->route('category.index');
        };

        return back()->withErrors([
            'name' => 'nothing changed'
        ]);

    }

    public function delete(Category $category) {
        Gate::authorize('delete', $category);
        $category->delete();

        return redirect()->back();
    }
}
