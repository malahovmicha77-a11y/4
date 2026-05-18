@extends('layouts.layout')

@section('title', 'Админ панель')
@section('header', 'Административная панель')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
    <li class="breadcrumb-item active">Данные</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Новые заказы</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection