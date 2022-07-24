<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $address = Address::where('user_id',Auth::user()->id)->get();
        return view('profile.index', ['user' => $user,'address'=>$address]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $user = User::find($id);
        $data = $request->validated();
return $data;
        if($data['password'] == null){
            unset($data['password']);

        } else{

            $data['password'] =Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('profile.index');

    }

}
