@extends('layouts.app')

@section('title')
    Профиль
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

    <form method="post" action="{{ route('saveProfile') }}">
        @csrf
        <input type="hidden" name="userId" value="{{ $user->id }}" name="userId">
        <div class="mb-3">  
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input name="name" value="{{ $user->name }}" class="form-control">
        </div>
            <div class="mb-3 form-check">
            </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection