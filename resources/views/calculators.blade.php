@extends('layouts.app')

@section('title')
    Калькуляторы
@endsection

@section('content')
    <a href="{{route('adminUsers') }}">Разбавление самогона водой</a>
    <a href="{{route('adminCategories') }}">Смешивание спиртов разной крепости</a>
    <a href="{{route('adminProducts') }}">Дробная перегонка спирта-сырца</a>
    <a href="{{route('adminUsers') }}">Расчет сахарной браги</a>
    <a href="{{route('adminCategories') }}">Замена сахара глюкозой</a>
    <a href="{{route('adminProducts') }}">Абсолютного спирта и отбора голов</a>
@endsection