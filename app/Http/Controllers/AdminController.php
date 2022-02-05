<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }

    public function users()
    {
        $users = User::get();
        

        $data = [
            'title' => 'Список пользователей',
            'users' => $users
        ];
        return view('admin.users', $data);
    }

    public function products()
    {
        $products = Product::get();
        

        $data = [
            'title' => 'Список продуктов',
            'products' => $products
        ];
        return view('admin.products', $data);
    }

    public function categories()
    {
        $categories = Category::get();
        

        $data = [
            'title' => 'Список продуктов',
            'categories' => $categories
        ];
        return view('admin.categories', $data);
    }

    public function enterAsUser($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('home');
    }

    public function enterAsProduct($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('profileProduct');
    }

    


}

