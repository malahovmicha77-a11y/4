<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create([
            'name' => $request->name,
            'title' => $request->name,
        ]);

        return redirect()->route('tags.index')->with('success', 'Тег успешно создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $request->name,
            'title' => $request->name,
        ]);

        return redirect()->route('tags.index')->with('success', 'Тег успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        
        // Временно отключаем проверку на посты (если нет deleted_at в posts)
        // if ($tag->posts()->count() > 0) {
        //     return redirect()->route('tags.index')->with('error', 'Нельзя удалить тег, который используется в постах!');
        // }
        
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Тег успешно удален!');
    }
}