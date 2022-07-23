<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\AddRequest;
use App\Models\Address;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index()
    {

        $basket = Basket::where('user_id', Auth::user()->id)->with('menu')->get();

        return $basket;

    }
    public function add(AddRequest $request, $menu_id)
    {


        $data = $request->validated();
        $basket_item = Basket::where([
            ['user_id', Auth::user()->id],
            ['menu_id', $menu_id]
        ])->first();

        if ($basket_item == null) {
            $data['menu_id'] = $menu_id;
            $data['user_id'] = Auth::user()->id;
            Basket::create($data);
        } else {
            $basket_item->update($data);
        }

        return 201;
    }
    public function destroy($id)
    {
        $basket_item = Basket::find($id);
        if($basket_item->user_id == Auth::user()->id){
            $basket_item->delete();
        }
        return 201;
    }
}
