<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\AddRequest;
use App\Models\Address;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basket = Basket::where('user_id', Auth::user()->id)->get();
        $address = Address::where('user_id',Auth::user()->id)->get();
        return view('basket.index', ['basket' => $basket, 'address'=>$address]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $basket_item = Basket::find($id);
        if($basket_item->user_id == Auth::user()->id){
            $basket_item->delete();
        }
        return redirect()->back();
    }
}
