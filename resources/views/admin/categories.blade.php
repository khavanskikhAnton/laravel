@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('content')
    <h1>
        Список категорий
    </h1>

    <a href="{{route('adminUsers') }}">Список пользователей</a>
    <a href="{{route('adminCategories') }}">Список категорий</a>
    <a href="{{route('adminProducts') }}">Список продуктов</a>

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
                </tr>
            @endforeach
            
        </tbody>
        

    </table>




@endsection