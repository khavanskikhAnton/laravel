@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('styles')
    <style>
        .category-picture { 
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
        Список категорий
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
                <th class="text-center">Название категории</th>
                <th class="text-center">Описание</th>
                <th class="text-center">Изображение</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $categories)
                <tr>
                    <td class="text-center">{{ $categories->id }}</td>
                    <td class="text-center">{{ $categories->name }}</td>
                    <td class="text-center">{{ $categories->description }}</td>
                    <td class="text-center">{{ $categories->picture }}</td>
                    <td><a href="{{ route('profileCategory', $categories->id) }}">Редактировать</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection