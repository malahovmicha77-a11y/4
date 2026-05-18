@extends('layouts.layout')

@section('title', 'Посты')
@section('header', 'Управление постами')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item active">Посты</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Список постов</h3>
        <div class="card-tools">
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Добавить пост
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Изображение</th>
                    <th>Заголовок</th>
                    <th>Категория</th>
                    <th>Теги</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted">Нет</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($post->title, 50) }}</td>
                    <td>{{ $post->category->title ?? 'Без категории' }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                            <span class="badge badge-info">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                            {{ $post->status == 'published' ? 'Опубликован' : 'Черновик' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Посты не найдены</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $posts->links() }}
    </div>
</div>
@endsection