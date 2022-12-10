<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Obat;
use Carbon\Carbon;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //method read atau menampilkan semua data Obat
    {
        $obats = Obat::all();

        if(count($Obats) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $obats
            ], 200);
        } //return data semua Obat dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400); //return message data course kosong
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //method create atau menambahkan sebuah data Obat
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'obat' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $obat = Obat::create($storeData);
        return response([
            'message' => 'Add Obat Success',
            'data' => $obat
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //method search atau menampilkan sebuah data Obat
    {
        $Obat = Obat::find($id); //mencari data Obat berdasarkan id

        if(!is_null($Obat)){
            return response([
                'message' => 'Retrieve Obat Success',
                'data' => $Obat
            ], 200);
        }

        return response([
            'message' => 'Obat Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //method update atau mengubah sebuah data Obat
    {
        $Obat = Obat::find($id);
        if(is_null($Obat)){
            return response([
                'message' => 'Obat Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'obat' => 'required|alpha_spaces',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $Obat->obat = $updateData['obat'];
        $Obat->jenis = $updateData['jenis'];
        $Obat->harga = $updateData['harga'];

        if($Obat->save()){
            return response([
                'message' => 'Update Obat Success',
                'data' => $Obat
            ], 200);
        }

        return response([
            'message' => 'Update Obat Failed',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //method delete atau menghapus sebuah data Obat
    {
        $Obat = Obat::find($id);

        if(is_null($Obat)){
            return response([
                'message' => 'Obat Not Found',
                'data' => 'null'
            ], 404);
        }

        if($Obat->delete()){
            return response([
                'message' => 'Delete Obat Success',
                'data' => $Obat
            ], 200);
        }

        return response([
            'message' => 'Delete Obat Failed',
            'data' => 'null'
        ], 400);
    }
}
