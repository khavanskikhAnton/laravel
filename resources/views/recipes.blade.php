@extends('layouts.app')

@section('title')
    Рецепты
@endsection

@section('content')
    <a href="{{route('adminUsers') }}">Брага</a>
    <a href="{{route('adminCategories') }}">Наливки</a>
    <a href="{{route('adminProducts') }}">Настойки</a>
    <a href="{{route('adminUsers') }}">Сборы</a>
    <a href="{{route('adminCategories') }}">Закуски</a>
@endsection