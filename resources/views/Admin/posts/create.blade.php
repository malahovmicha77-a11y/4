@extends('layouts.layout')

@section('title', 'Создать пост')
@section('header', 'Создание поста')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Посты</a></li>
    <li class="breadcrumb-item active">Создание</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Создать пост</h3>
        <div class="card-tools">
            <a href="{{ route('posts.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">Заголовок <span class="text-danger">*</span></label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       class="form-control @error('title') is-invalid @enderror" 
                       placeholder="Введите заголовок"
                       value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="category_id">Категория <span class="text-danger">*</span></label>
                <select name="category_id" 
                        id="category_id" 
                        class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="tags">Теги (множественный выбор)</label>
                <select name="tags[]" id="tags" class="form-control select2" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Содержание <span class="text-danger">*</span></label>
                <textarea name="content" 
                          id="content" 
                          class="form-control @error('content') is-invalid @enderror" 
                          rows="10" 
                          placeholder="Введите текст поста">{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" 
                       name="image" 
                       id="image" 
                       class="form-control-file @error('image') is-invalid @enderror">
                <small class="text-muted">Разрешены: jpeg, png, jpg, gif. Максимум 2MB</small>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="status">Статус</label>
                <select name="status" id="status" class="form-control">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Черновик</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Опубликован</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Сохранить
            </button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tags').select2({
            theme: 'bootstrap4',
            placeholder: 'Выберите теги',
            allowClear: true
        });
    });
</script>
@endpush