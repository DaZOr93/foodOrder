<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['apartment','city','house','street','user_id'];

    public function order()
    {
        $this->hasOne(Order::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
