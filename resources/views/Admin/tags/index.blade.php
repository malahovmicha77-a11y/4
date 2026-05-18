@extends('layouts.layout')

@section('title', 'Теги')
@section('header', 'Управление тегами')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item active">Теги</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Список тегов</h3>
        <div class="card-tools">
            <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Добавить тег
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Slug</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
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
                    <td colspan="4" class="text-center">Теги не найдены</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $tags->links() }}
    </div>
</div>
@endsection