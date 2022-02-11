@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('styles')
    <style>
        .category-picture { 
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
        Список категорий
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
                <th class="text-center">Название категории</th>
                <th class="text-center">Описание</th>
                <th class="text-center">Изображение</th>
                <th class="text-center">Редактировать</th>
                <th class="text-center">Удалить</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $categories)
                <tr>
                    <td class="text-center">{{ $categories->id }}</td>
                    <td class="text-center">{{ $categories->name }}</td>
                    <td class="text-center">{{ $categories->description }}</td>
                    <td class="text-center">{{ $categories->picture }}</td>
                    <td><a href="{{ route('profileCategory', $categories->id) }}">Редактировать</a></td>
                    <td class="text-center">
                        <form method="post" action="{{ route('deleteCategory', $categories->id) }}">
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

    <form method="post" action="{{ route('createCategory') }}" class="mb-3 border-bottom" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label class="form-label"><h4>Создать новую категорию</h4></label>
            <input type="text" name="name" placeholder="Введите наименование создаваемой категории" class="form-control">
        </div>
        <div class="mb-2">
            <textarea type="text" name="description" placeholder="Введите описание создаваемой категории" class="form-control"></textarea>
        </div>
        <div class="mb-2">
            <label class="form-label">Изображение создаваемой категории</label>
            <input type="file" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning mb-2">Создать категорию</button>
    </form>

    @if (session('startImportCategories'))
        <div class="alert alert-success">
            Импорт категорий из файла запущен
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
        <form method="post" action="{{ route('importCategories') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label"><h4>Импортировать категории из файла<br></h4>Файл для импорта категорий</label>
                <input type="file" name="importFile" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Загрузить категории из файла</button>
        </form>
        @if (session('startExportCategories'))
    <div class="alert alert-success">
        Выгрузка категорий запущена
    </div>
    @endif
        <form class="mb-2 border-top" method="post" action="{{ route('exportCategories') }}">
            @csrf
            <div>
                <label class="form-label mt-2"><h4>Выгрузить список категорий в файл</h4></label>
            </div>
            <button type="submit" class="btn btn-primary">Выгрузить категории</button>
        </form>
@endsection