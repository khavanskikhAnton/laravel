<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\ControllersCommand;


class CalculatorsController extends Controller{

    public function calculators(){
        return view('calculators');
    }
}

