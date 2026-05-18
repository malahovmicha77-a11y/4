<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'  // 
        ]);

        // Обработка изображения (сохранение в public/uploads/posts)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $imageName);
            $imagePath = 'uploads/posts/' . $imageName;
        }

        // Создание поста
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        // Привязка тегов
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан!');
    }

    public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        // Обработка изображения
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            // Удалить старое изображение
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $imageName);
            $imagePath = 'uploads/posts/' . $imageName;
        }

        // Обновление поста
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        // Синхронизация тегов
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Пост успешно обновлен!');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        // Удалить изображение
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Пост успешно удален!');
    }
}