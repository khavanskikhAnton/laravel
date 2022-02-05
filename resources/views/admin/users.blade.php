@extends('layouts.app')

@section('title')
    Список пользователей
@endsection

@section('content')
    <h1>
        {{ $title }}
    </h1>

    <a href="{{route('adminUsers') }}">Список пользователей</a>
    <a href="{{route('adminCategories') }}">Список категорий</a>
    <a href="{{route('adminProducts') }}">Список продуктов</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Имя</th>
                <th class="text-center">Почта</th>
                <th class="text-center">Админ</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ $user->id }}</td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->is_admin }}</td>
                    <td class="text-center">
                        <a href="{{ route('enterAsUser', $user->id) }}">Войти</a>
                    </td>
                </tr>
            @endforeach
            
        </tbody>

    </table>
@endsection

