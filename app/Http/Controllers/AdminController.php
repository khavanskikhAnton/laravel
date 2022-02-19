<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTemporaryFiles;
use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Jobs\ImportCategories;
use App\Jobs\ImportProducts;
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

	public function createCategory (Request $request) // Создание новой категории
	{
		$input = $request->all();
		$name = $input['name'];
		$description = $input['description'];
		$picture = $input['picture'] ?? null;
		$category = new Category([
			'name' => $name,
			'description' => $description,
			'picture' => $picture
		]);
		request()->validate([
			'name' => 'required',
			'description' => "required",
			'picture' => 'nullable|mimetypes:image/*',
		]);
		if ($picture) {
			$mimeType = $request->file('picture')->getMimeType();
			$type = explode('/', $mimeType);

			if ($type[0] == 'image') {
				$ext = $picture->getClientOriginalExtension();
				$fileName = time() . rand(10000, 99999). "." . $ext;
				$picture->storeAs('public/categories', $fileName);
				$category->picture = "$fileName";
			}
		} else {
			$category->picture = 'no_picture.png';
		}
		$category->save();
		return back();
	}

	public function deleteCategory ($id)
	{
		Category::where('id', $id)->delete();
		return back();
	}

	public function exportCategories () // Экспорт списка категорий в файл
	{
		ExportCategories::dispatch();
		session()->flash('startExportCategories');
		return back();		
	}

	public function importCategories (Request $request) // Импорт списка категорий из файла
	{
		$input = request()->all();
		$importFile = $input['importFile'] ?? null;

		if ($importFile) {
			// request()->validate([
			//     'importFile' => 'mimetypes:text/*',
			// ]);
			$mimeType = $request->file('importFile')->getMimeType();
			$type = explode('/', $mimeType);
			if ($type[0] == 'text') {

				$ext = $importFile->getClientOriginalExtension();
				$fileName = "importCategories." . $ext;
				$importFile->storeAs('public/categories', $fileName);
				ImportCategories::dispatch();
				session()->flash('startImportCategories');
			} else {
				session()->flash('importFileError');
			}

		} else {
			session()->flash('importFileIsMissing');
		}
		
		DeleteTemporaryFiles::dispatch();
		return back();
	}

	public function createProduct (Request $request) // Создание нового продукта
	{
		$input = $request->all();
		$name = $input['name'];
		$description = $input['description'];
		$price = $input['price'];
		$picture = $input['picture'] ?? null;
		$category_id = $input['category_id'] ?? null; 
		$product = new Product([
			'name' => $name,
			'description' => $description,
			'category_id' => $category_id,
			'picture' => $picture,
			'price' => $price
		]);
		request()->validate([
			'name' => 'required',
			'description' => "required",
			'price' => "required",
			'picture' => 'nullable|mimetypes:image/*',
		]);
		if ($picture) {
			$mimeType = $request->file('picture')->getMimeType();
			$type = explode('/', $mimeType);

			if ($type[0] == 'image') {
				$ext = $picture->getClientOriginalExtension();
				$fileName = time() . rand(10000, 99999). "." . $ext;
				$picture->storeAs('products', $fileName);
				$product->picture = "$fileName";
			}
		} else {
				$product->picture = 'no_picture.png';
		}
		$product->save();
		return back();
	}
	
	public function deleteProduct ($id)
	{
		Product::where('id', $id)->delete();
		return back();
	}
	public function exportProducts () // Экспорт списка продуктов в файл
	{
		ExportProducts::dispatch();
		session()->flash('startExport');
		return back();
	}

	public function importProducts (Request $request)
	{
		$input = request()->all();
		$importFile = $input['importFile'] ?? null;

		if ($importFile) {
			
			$mimeType = $request->file('importFile')->getMimeType();
			$type = explode('/', $mimeType);
				
			if ($type[0] == 'text') {
				$ext = $importFile->getClientOriginalExtension();
				$fileName = "importProducts." . $ext;
				$importFile->storeAs('public/products', $fileName);

				ImportProducts::dispatch();
				session()->flash('startImport');
				
			} else {
				session()->flash('importFileError');
			}

		} else {
				session()->flash('importFileIsMissing');
		}
		
		DeleteTemporaryFiles::dispatch();
		return back();
	}


}

