<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileProductController extends Controller
{
	public function profileProduct($id)
    {
		$product = Product::findOrFail($id);
        return view('profileProduct', compact('product'));
    }





	 


}