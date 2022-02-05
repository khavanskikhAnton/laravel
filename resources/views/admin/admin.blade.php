@extends('layouts.app')

@section('title')
    Админка
@endsection

@section('content')

    <ul class="navbar-bottom">
        <li><a href="{{route('adminUsers') }}">Список пользователей</a></li>
        <li><a href="{{route('adminCategories') }}">Список категорий</a></li>
        <li><a href="{{route('adminProducts') }}">Список продуктов</a></li>
    </ul>
@endsection