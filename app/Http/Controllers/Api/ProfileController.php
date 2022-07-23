<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        return $user;
    }

    public function update(UpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $data = $request->validated();
        if($data['password'] == null){
            unset($data['password']);

        } else{

            $data['password'] =Hash::make($request->password);
        }

        $user->update($data);

        return 200;

    }
}
