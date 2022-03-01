<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['apartment','city','house','street','user_id'];

    protected $table = 'address';

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
