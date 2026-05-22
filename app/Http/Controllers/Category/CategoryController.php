<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(10)->withQueryString();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can create categories.');
        }
        return view('category.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can create categories.');
        }

        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('name', 'description'));

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show is not used publicly — redirect to index.
     */
    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can edit categories.');
        }
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can edit categories.');
        }

        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->only('name', 'description'));

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can delete categories.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
