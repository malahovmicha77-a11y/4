<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
use App\Models\Category;  // ← ДОБАВИТЬ: импорт модели Category
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class CategoryController extends RoutingController
{
 
    public function index()
    {
        $categories = Category::all();
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
        dd('Метод store: создание категории', $request->all());
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('Метод show: просмотр категории ID: ' . $id);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd('Метод edit: редактирование категории ID: ' . $id);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('Метод update: обновление категории ID: ' . $id, $request->all());
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('Метод destroy: удаление категории ID: ' . $id);
    }
}