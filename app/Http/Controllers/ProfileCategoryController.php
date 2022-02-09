<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProfileCategoryController extends Controller
{
    public function profileCategory($id)
    {
		$category = Category::findOrFail($id);
        return view('profileCategory', compact('category'));
    }

    public function save(Request $request)
    {
        $input = request()->all();

        $name = $input['name'];
        $description = $input['description'];
        $categoryId = $input['categoryId'];
        $picture = $input['picture'] ?? null;
        $category = Category::find($categoryId);

        request()->validate([
            'name' => 'required',
            'picture' => 'mimes: image,bmp,jpg,jpeg'
        ]);

        if($picture) {
           
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/categories', $fileName);
            $category->picture = $fileName;
        }
        $category->name = $name;
        $category->description = $description;
        $category->save();
        return back();
    }
}
