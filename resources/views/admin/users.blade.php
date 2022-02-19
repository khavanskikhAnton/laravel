@extends('layouts.app')

@section('title')
	Список пользователей
@endsection

@section('styles')
	<style>
		.li-navbar {
			list-style:none;
		}
	</style>
@endsection

@section('content')
	<h1>
		Список ролей
	</h1>
	@if($errors->isNotEmpty())
    <div class="alert alert-warning" role="alert">
        @foreach($errors->all() as $error)
            {{ $error }} 
            @if (!$loop->last) <br> @endif
        @endforeach
    </div>
@endif
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Название</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($roles as $idx => $role)
				<tr>
					<td class="text-center">{{ $idx + 1 }}</td>
					<td class="text-center">{{ $role -> name }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="2">Ролей пока нет</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	<form method="post" action="{{ route('addRole') }}" class="mb-4">
	@csrf
	<label class="mb-2">Создать новую роль</label>
	<input class="form-control mb-2" name="name" placeholder="Введите название новой роли">
	<button type="submit" class="btn btn-success" >Создать</button>
	</form>

	<form method="post" action="{{ route('addRoleToUser')}}">
			@csrf
			<select class="form-control text-center mb-2" name="user_id">
				<option disabled selected>Укажите пользователя</option>
				@foreach ($users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
				@endforeach
			</select>
			<select class="form-control text-center mb-2" name="role_id">
				<option disabled selected>Укажите роль</option>
				@foreach ($roles as $role)
					<option value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach
			</select>
			<button type="submit" style="height: 37px" class="btn btn-warning">Применить</button>
	</form>

	<ul class="navbar-bottom">
		<li class="li-navbar"><a href="{{route('adminUsers') }}">Список пользователей</a></li>
		<li class="li-navbar"><a href="{{route('adminCategories') }}">Список категорий</a></li>
		<li class="li-navbar"><a href="{{route('adminProducts') }}">Список продуктов</a></li>
	</ul>
	<h1>
		{{ $title }}
	</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Имя</th>
				<th class="text-center">Почта</th>
				<th class="text-center">Роли</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td class="text-center">{{ $user->id }}</td>
					<td class="text-center">{{ $user->name }}</td>
					<td class="text-center">{{ $user->email }}</td>
					<td class="text-center">
						<ul>
							@foreach ($user->roles as $role)
							<li>{{ $role->name }}</li>
							@endforeach
						</ul>
					</td>
					</td>
					<td class="text-center">
							<a href="{{ route('enterAsUser', $user->id) }}">Войти</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

