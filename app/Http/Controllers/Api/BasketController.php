<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\AddRequest;
use App\Models\Address;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $user = 3;
        $basket = Basket::where('user_id', $user)->with('menu')->get();

        return $basket;

    }
    public function add(AddRequest $request, $menu_id)
    {

        $user = 3;
        $data = $request->validated();
        $basket_item = Basket::where([
            ['user_id', $user],
            ['menu_id', $menu_id]
        ])->first();

        if ($basket_item == null) {
            $data['menu_id'] = $menu_id;
            $data['user_id'] = $user;
            Basket::create($data);
        } else {
            $basket_item->update($data);
        }

        return 201;
    }
}
