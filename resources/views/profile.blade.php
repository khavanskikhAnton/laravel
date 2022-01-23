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
            display:block;
        }
       
    </style>
@endsection

@section('content')

    @if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                @if (!$loop->last)<br>@endif
            @endforeach
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
            <label class="form-label">Список адресов</label>
            <ul>
                @forelse ($user->addresses as $address)
                    <li @if($address->main) class="b5 text-primary" @endif>
                        {{ $address->address }}
                    </li>
                    @empty <em>Ку-ку)</em>
                @endforelse
            </ul>
        </div>
        <div class="mb-3">
            <label class="form-label">Новый адрес</label>
            <input name="new_address" class="form-control">
        </div>
            <div class="mb-3 form-check">
            </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection