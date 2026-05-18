@extends('layouts.layout')

@section('title', 'Редактировать тег')
@section('header', 'Редактирование тега')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Теги</a></li>
    <li class="breadcrumb-item active">Редактирование</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Редактировать тег</h3>
        <div class="card-tools">
            <a href="{{ route('tags.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название тега</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection