{{ date('Y-m-d H:i:s')}}

<h1>
    {{ $title }}
</h1>

@if ($number > 9)
    Ваше число больше 5
@else
    Ваше число меньше 5
@endif
<ul>
@foreach ($numbers as $number)  
    <li>
        {{ $number}}
    </li>
@endforeach
</ul>

@empty ($cities)
Список  городов пустой
@endempty

@isset ($cities)
ПЕРЕМЕННАЯ НЕ ЗАДАНА
@endisset

<br>

@auth 
    Вы авторизованы
@endauth

@guest
    Вы гость
@endguest
