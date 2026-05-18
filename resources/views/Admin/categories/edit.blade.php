@extends('layouts.layout')

@section('title', 'Редактировать категорию')
@section('header', 'Редактирование категории')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
    <li class="breadcrumb-item active">Редактирование</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Редактировать категорию</h3>
        <div class="card-tools">
            <a href="{{ route('categories.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название категории</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $category->title }}">
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection