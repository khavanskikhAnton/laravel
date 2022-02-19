@extends('layouts.app')

@section('title')
	Список продуктов
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
	<h1>
		{{ $title }}
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
				<th class="text-center">Название продукта</th>
				<th class="text-center">Описание</th>
				<th class="text-center">Категория</th>
				<th class="text-center">Изображение</th>
				<th class="text-center">Цена</th>
				<th class="text-center">Редактировать</th>
				<th class="text-center">Удалить</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $products)
				<tr>
					<td class="text-center">{{ $products->id }}</td>
					<td class="text-center">{{ $products->name }}</td>
					<td class="text-center">{{ $products->description }}</td>
					<td class="text-center">{{ $products->category_id }}</td>
					<td class="text-center">{{ $products->picture }}</td>
					<td class="text-center">{{ $products->price }}</td>
					<td><a href="{{ route('profileProduct', $products->id) }}">Редактировать</a></td>
					<td class="text-center">
						<form method="post" action="{{ route('deleteProduct', $products->id) }}">
							@csrf
							<button type="submit" class="btn btn-danger">
								<strong>X</strong>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>		
	</table>
	@if($errors->isNotEmpty())
		<div class="alert alert-warning" role="alert">
			@foreach($errors->all() as $error)
				{{ $error }} 
				@if (!$loop->last) <br> @endif
			@endforeach
		</div>
	@endif

	<form method="post" action="{{ route('createProduct') }}" class="mb-3 border-bottom" enctype="multipart/form-data">
		@csrf
		<div class="mb-2">
			<label class="form-label"><h4>Создать новый продукт</h4></label>
			<input type="text" name="name" placeholder="Введите наименование создаваемого продукта" class="form-control">
		</div>
		<div class="mb-2">
			<textarea type="text" name="description" placeholder="Введите описание создаваемого продукта" class="form-control"></textarea>
		</div>
		<div class="mb-2">
			<textarea type="text" name="price" placeholder="Введите цену создаваемого продукта" class="form-control"></textarea>
		</div>
		
		<div class="mb-2">
			<label class="form-label">Изображение создаваемого продукта</label>
			<input type="file" name="picture" class="form-control">
		</div>
		<button type="submit" class="btn btn-warning mb-2">Создать продукт</button>
	</form>

	@if (session('startImport'))
		<div class="alert alert-success">
			Импорт из файла запущен
		</div>
	@endif

	@if (session('importFileError'))
		<div class="alert alert-warning">
			Тип загружаемого файла не соответствует требуемому, необходимо загрузить файл с расширением .csv!
		</div>
	@endif
		
	@if (session('importFileIsMissing'))
		<div class="alert alert-warning">
			Файл не найден, загрузите файл в формате .csv!
		</div>
	@endif
	<form method="post" action="{{ route('importProducts') }}" enctype="multipart/form-data">
		@csrf
		<div class="mb-3">
			<label class="form-label"><h4>Импортировать продукты из файла<br></h4>Файл для импорта продуктов</label>
			<input type="file" name="importFile" class="form-control">
		</div>
		<button type="submit" class="btn btn-success">Загрузить продукты из файла</button>
	</form>

	@if (session('startExport'))
    <div class="alert alert-success">
        Выгрузка запущена
    </div>
    @endif
    <form class="mb-2 border-top" method="post" action="{{ route('exportProducts') }}">
        @csrf
        <div>
            <label class="form-label mt-2"><h4>Выгрузить список продуктов в файл</h4></label>
        </div>
        <button type="submit" class="btn btn-primary">Выгрузить продукты</button>
    </form>
    <form class="mb-2" method="post" action="{{ route('deleteExportFile')}}">
        @csrf
        @if (file_exists('C:\Work\Laravel\eshop\storage\app\public\products\exportProducts.csv')) 
        <a class="btn btn-success" href="/storage/products/exportProducts.csv">Скачать файл</a>
        <button type="submit" class="btn btn-danger">Очистить</button>
        @endif
    </form> 
		
@endsection