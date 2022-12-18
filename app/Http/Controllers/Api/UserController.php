<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function show($username) //method search atau menampilkan sebuah data product
    {
        $user = User::where('username',$username)->get(); //mencari data product berdasarkan id

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404);
    }

    public function update(Request $request, $username) //method update atau mengubah sebuah data product
    {
        $user = User::where('username',$username)->first();
        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'username' => 'required',
            'email' => 'required|unique:users',
            'tgglLahir' => 'required',
            'telepon' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->username = $updateData['username'];
        $user->email = $updateData['email'];
		$user->tgglLahir = $updateData['tgglLahir'];
		$user->telepon = $updateData['telepon'];
        
        if($user->save()){
            return response([
                'message' => 'Update User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Update User Failed',
            'data' => null
        ], 400);
    }
}
