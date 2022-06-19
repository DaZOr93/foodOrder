<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['address','status','phone','comment','order_price','user_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsToMany(Menu::class)->withPivot('price', 'quantity', 'total_cost' , 'name');;
    }
}
