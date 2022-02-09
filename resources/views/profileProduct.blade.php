@extends('layouts.app')

@section('title')
    Редактирование продукта
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
    <h1>Редактирование продукта</h1>

    <ul class="navbar-bottom">
        <li class="li-navbar"><a href="{{route('adminUsers') }}">Список пользователей</a></li>
        <li class="li-navbar"><a href="{{route('adminCategories') }}">Список категорий</a></li>
        <li class="li-navbar"><a href="{{route('adminProducts') }}">Список продуктов</a></li>
    </ul>

    @if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                @if (!$loop->last)<br>@endif
            @endforeach
        </div>
    @endif

    <form method="post" action="{{ route('saveProfileProduct') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $product->id }}" name="productId">
        <div class="mb-3">  
            <label class="form-label">Изображение</label>
            <image class="product-picture" src="{{ asset('storage/products') }}/{{ $product->picture }}">
            <input type="file" name="picture" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input name="name" value="{{ $product->name }}" class="form-control">
        </div>
		  <div class="mb-3">
            <label class="form-label">Описание</label>
            <input name="description" value="{{ $product->description }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Категория</label>
            <input name="category" value="{{ $product->category }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection