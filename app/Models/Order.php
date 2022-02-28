<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'address_id'
	];

	public function products()
	{
		return $this->belongsToMany(Product::class)
			->withPivot([
				'price',
				'quantity'
			])
			->withTimestamps();
	}
	public function getAddress($addressId)
	{
		$address = Address::find($addressId)->address;

		return  $address;
	}
}
