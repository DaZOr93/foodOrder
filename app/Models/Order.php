<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function address()
    {
        $this->belongsTo(Address::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function menu()
    {
        $this->belongsToMany(Menu::class);
    }
}
