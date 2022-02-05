@extends('layouts.app')

@section('title')
    Список продуктов
@endsection

@section('content')
    <h1>
        Список продуктов
    </h1>

    

    <a href="{{route('adminUsers') }}">Список пользователей</a>
    <a href="{{route('adminCategories') }}">Список категорий</a>
    <a href="{{route('adminProducts') }}">Список продуктов</a>

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
                    
                </tr>
            @endforeach
            
        </tbody>

    </table>
@endsection