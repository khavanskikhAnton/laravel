<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
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
        $products = Products::get();
        

        $data = [
            'title' => 'Список продуктов',
            'products' => $products
        ];
        return view('admin.products', $data);
    }

    public function categories()
    {
        $categories = Categories::get();
        

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




}

