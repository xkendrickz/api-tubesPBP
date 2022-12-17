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
    public function index() //method read atau menampilkan semua data product
    {
        $users = User::all();

        if(count($users) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $users
            ], 200);
        } //return data semua product dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400); //return message data course kosong
    }

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

    public function destroy($id) //method delete atau menghapus sebuah data product
    {
        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => 'null'
            ], 404);
        }

        if($user->delete()){
            return response([
                'message' => 'Delete User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Delete User Failed',
            'data' => 'null'
        ], 400);
    }
}
