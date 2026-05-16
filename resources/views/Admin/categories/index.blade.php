
@extends('layouts.layout')

@section('title', 'Категории')
@section('header', 'Управление категориями')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item active">Категории</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Список категорий</h3>
        <div class="card-tools">
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Добавить категорию
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
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить категорию?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Категории не найдены</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection