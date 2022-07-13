<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
       $user = 3;
        $address = Address::where('user_id',$user)->get();
        return $address;

    }
}
