@extends('layouts.app')

@section('title')
    Список продуктов
@endsection

@section('styles')
    <style>
        .product-picture { 
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display:block;
        }

        .li-navbar {list-style:none;}

    </style>
@endsection

@section('content')
    <h1>
        {{ $title }}
    </h1>
    <ul class="navbar-bottom">
		<li class="li-navbar"><a href="{{route('adminUsers') }}">Список пользователей</a></li>
		<li class="li-navbar"><a href="{{route('adminCategories') }}">Список категорий</a></li>
		<li class="li-navbar"><a href="{{route('adminProducts') }}">Список продуктов</a></li>
	</ul>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Название</th>
                <th class="text-center">Описание</th>
                <th class="text-center">Категория</th>
                <th class="text-center">Изображение</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $products)
                <tr>
                    <td class="text-center">{{ $products->id }}</td>
                    <td class="text-center">{{ $products->name }}</td>
                    <td class="text-center">{{ $products->description }}</td>
                    <td class="text-center">{{ $products->category }}</td>
                    <td class="text-center">{{ $products->picture }}</td>
                    <td><a href="{{ route('profileProduct', $products->id) }}">Редактировать</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection