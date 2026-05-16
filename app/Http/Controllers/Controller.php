<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Временная заглушка
        dd('Метод store: создание категории', $request->all());
    }

    public function show($id)
    {
        // Временная заглушка
        dd('Метод show: просмотр категории ID: ' . $id);
    }

    public function edit($id)
    {
        // Временная заглушка
        dd('Метод edit: редактирование категории ID: ' . $id);
    }

    public function update(Request $request, $id)
    {
        // Временная заглушка
        dd('Метод update: обновление категории ID: ' . $id, $request->all());
    }

    public function destroy($id)
    {
        // Временная заглушка
        dd('Метод destroy: удаление категории ID: ' . $id);
    }
}