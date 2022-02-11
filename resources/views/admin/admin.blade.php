@extends('layouts.app')

@section('title')
    Админка
@endsection

@section('styles')
    <style>

        .li-navbar {list-style:none;}
        

    </style>
@endsection

@section('content')
    <h1>
        Админка
    </h1>
    <ul class="navbar-bottom">
		<li class="li-navbar"><a href="{{route('adminUsers') }}">Список пользователей</a></li>
		<li class="li-navbar"><a href="{{route('adminCategories') }}">Список категорий</a></li>
		<li class="li-navbar"><a href="{{route('adminProducts') }}">Список продуктов</a></li>
	</ul>
@endsection