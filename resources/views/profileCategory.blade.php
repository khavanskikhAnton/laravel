@extends('layouts.app')

@section('title')
    Редактирование категории
@endsection

@section('styles')
    <style>
        .category-picture { 
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display:block;
        }

		  .li-navbar {list-style:none};
       
    </style>
@endsection

@section('content')
	<h1>Редактирование категории</h1>

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

	<form method="post" action="{{ route('saveProfileCategory') }}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" value="{{ $category->id }}" name="categoryId">
		<div class="mb-3">  
			<label class="form-label">Изображение</label>
			<image class="category-picture" src="{{ asset('storage/categories') }}/{{ $category->picture }}">
			<input type="file" name="picture" class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">Название</label>
			<input name="name" value="{{ $category->name }}" class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">Описание</label>
			<input name="description" value="{{ $category->description }}" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">Изменить</button>
	</form>
@endsection