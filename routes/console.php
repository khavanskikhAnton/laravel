<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('deleteCategory', function() {
    $category = new Category([
        'name'=>'Видеокарты',
        'discription'=> 'Ждем rtx 3050'
    ]);
    $category->save();
});





Artisan::command('createCategory', function() {
    $category = new Category([
        'name'=>'Видеокарты',
        'discription'=> 'Ждем rtx 3050'
    ]);
    $category->save();
});

Artisan::command('inspire', function () {
    $user = User::find(2);
    $addresses = $user->addresses;
    

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
