@extends('layouts.layout')

@section('title', 'Создать тег')
@section('header', 'Создание тега')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Теги</a></li>
    <li class="breadcrumb-item active">Создание</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Создать тег</h3>
        <div class="card-tools">
            <a href="{{ route('tags.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название тега</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Введите название">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
</div>
@endsection