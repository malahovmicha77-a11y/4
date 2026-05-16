@extends('admin.layouts.layout')

@section('title', 'Создать категорию')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Создать категорию</h3>
        <div class="card-tools">
            <a href="{{ route('categories.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название категории</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Введите название">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
</div>
@endsection