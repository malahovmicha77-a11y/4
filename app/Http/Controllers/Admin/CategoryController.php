<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title',
        ]);

        Category::create([
            'title' => $request->title,
        ]);

        return redirect()->route('categories.index')->with('success', 'Категория успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'title' => $request->title,
        ]);

        return redirect()->route('categories.index')->with('success', 'Категория успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->posts()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Нельзя удалить категорию, в которой есть посты!');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Категория успешно удалена!');
    }
}