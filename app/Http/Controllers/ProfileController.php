<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	public function profile(User $user)
	{
		if (!Auth::user())
			return redirect()->route('home');
		if (Auth::user()->isAdmin() || $user->id == Auth::user()->id)
			return view('profile', compact('user'));
	}

	public function save(Request $request)
	{
		$input = request()->all();
		$name = $input['name'];
		$email = $input['email'];
		$userId = $input['userId'];
		$picture = $input['picture'] ?? null;
		$newAddress = $input['new_address'];
		$user = User::find($userId);

		request()->validate([
			'name' => 'required',
			'email' => "email|required|unique:users,email, {$user->id}",
			'picture' => 'mimes: image,bmp,jpg,jpeg',
			'current_password' => 'current_password|required_with:password|nullable',
			'password' => 'confirmed|min:8|nullable'
		]);

		if ($input['password']) {
			$user->password = Hash::make($input['password']);
			$user->save();
		}


		Address::where('user_id', $user->id)->update([
			'main' => 0
		]);

		Address::where('id', $input['main_address'])->update([
			'main' => 1
		]);

		if ($newAddress) {

			Address::where('user_id', $user->id)->update([
				'main' => 0
			]);

			Address::create([
				'user_id' => $user->id,
				'address' => $newAddress,
				'main' => 1
			]);
		}

		if ($picture) {

			$ext = $picture->getClientOriginalExtension();
			$fileName = time() . rand(10000, 99999) . '.' . $ext;
			$picture->storeAs('public/users', $fileName);
			$user->picture = $fileName;
		}

		$user->name = $name;
		$user->email = $email;
		$user->save();
		session()->flash('prifileSaved');
		return back();
	}
	public function orders()
	{
		$user = Auth::user()->id;
		$orders = Order::where('user_id', $user)->get();
		$data = [
			'title' => 'Список заказов',
			'orders' => $orders,
		];
		return view('orders', $data);
	}
}
