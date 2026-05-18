<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Routing\Controller;

// use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $tag = Tag::where('name', 'Laravel 101')->first();

        if (!$tag) {
            $tag = Tag::create([
                'name' => 'Laravel 101',
                'slug' => 'laravel-101',
                'title' => 'Маршрут'
            ]);
        }

        return view('admin.index');
    }
}
