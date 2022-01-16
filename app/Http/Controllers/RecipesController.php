<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\ControllersCommand;


class RecipesController extends Controller{

    public function recipes(){
        return view('recipes');
    }
}


    
        
    