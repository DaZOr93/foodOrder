<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {

        $address = Address::where('user_id',Auth::user()->id)->get();
        return $address;

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        Address::create($data);
        return 201;
    }
}
