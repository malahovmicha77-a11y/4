<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Routing\Controller;

// use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $tag = Tag::create([
            'name' => 'Laravel 101',
            'slug' => 'laravel-102',
            'title' => 'wwww'
            
        ]);

        // $tag = new Tag();
        // $tag->title = 'Привет мир';
        // $tag->save();
        // return view ('admin.index');

        dd($tag); 
    }
}