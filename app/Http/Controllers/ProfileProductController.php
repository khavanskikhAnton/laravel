<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileProductController extends Controller
{
	public function profileProduct($id)
    {
		$product = Product::findOrFail($id);
        return view('profileProduct', compact('product'));
    }

    public function save(Request $request)
    {
        $input = request()->all();

        $name = $input['name'];
        $description = $input['description'];
        $productId = $input['productId'];
        $picture = $input['picture'] ?? null;
        $categoryId = $input['categoryId'] ; 
        $product = Product::find($productId);
        $price = $input['price'];

        request()->validate([
            'name' => 'required',
            'picture' => 'mimes: image,bmp,jpg,jpeg'
        ]);

        if($picture) {
           
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/products', $fileName);
            $product->picture = $fileName;
        }
        $product->name = $name;
        $product->description = $description;
        $product->category_id = $categoryId;
        $product->price = $price;
        $product->save();
        return back();
    }
}