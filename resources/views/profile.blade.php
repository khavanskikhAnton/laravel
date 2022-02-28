@extends('layouts.app')

@section('title')
Профиль
@endsection

@section('styles')
<style>
	.user-picture {
		width: 150px;
		height: 150px;
		border-radius: 50%;
		display: block;
	}

	.li-navbar {
		list-style: none
	}

	;
</style>
@endsection

@section('content')

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
@if (session('profileSaved'))
<div class="alert alert-success" role="alert">
	Профиль успешно сохранен!
</div>
@endif

<form method="post" action="{{ route('saveProfile') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" value="{{ $user->id }}" name="userId">
	<div class="mb-3">
		<label class="form-label">Изображение</label>
		<image class="user-picture" src="{{ asset('storage/users') }}/{{ $user->picture }}">
			<input type="file" name="picture" class="form-control">
	</div>
	<div class="mb-3">
		<label for="exampleInputEmail1" class="form-label">Почта</label>
		<input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	</div>
	<div class="mb-3">
		<label class="form-label">Имя</label>
		<input name="name" value="{{ $user->name }}" class="form-control">
	</div>
	<div class="mb-3">
		<label class="form-label">Текущий пароль</label>
		<input type="password" name="current_password" class="form-control">
	</div>
	<div class="mb-3">
		<label class="form-label">Новый пароль</label>
		<input type="password" name="password" class="form-control">
	</div>
	<div class="mb-3">
		<label class="form-label">Подтвердите пароль</label>
		<input type="password" name="password_confirmation" class="form-control">
	</div>
	<div class="mb-3">
		<label class="form-label">Список адресов</label>
		@forelse ($user->addresses as $address)<br>
		<label for="main_address{{ $address->id }}">{{ $address->address }}</label>
		<input @if ($address->main) checked @endif id="main_address{{ $address->id }}" name="main_address" type="radio" value="{{ $address->id }}">
		@empty <em>Ку-ку)</em>
		@endforelse
	</div>
	<div class="mb-3">
		<label class="form-label">Новый адрес</label>
		<input name="new_address" class="form-control">
	</div>
	<div class="mb-3 form-check"></div>
	<button type="submit" class="btn btn-primary mb-2">Сохранить</button>
</form>
<a class="btn btn-success next_button mb-2" aria-current="page" href="{{ route('orders') }}">
	<strong>Мои заказы</strong>
</a>
@endsection