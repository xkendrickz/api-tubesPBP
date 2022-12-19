<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Kontrasepsi;
use Carbon\Carbon;

class KontrasepsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //method read atau menampilkan semua data Kontrasepsi
    {
        $kontrasepsis = Obat::all();

        if(count($kontrasepsis) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kontrasepsis
            ], 200);
        } //return data semua Kontrasepsi dalam bentuk json

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
    public function store(Request $request) //method create atau menambahkan sebuah data Kontrasepsi
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'kontrasepsi' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $kontrasepsi = Kontrasepsi::create($storeData);
        return response([
            'message' => 'Add Kontrasepsi Success',
            'data' => $kontrasepsi
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //method search atau menampilkan sebuah data Kontrasepsi
    {
        $Kontrasepsi = Kontrasepsi::where('id',$id)->get(); //mencari data Kontrasepsi berdasarkan id

        if(!is_null($Kontrasepsi)){
            return response([
                'message' => 'Retrieve Kontrasepsi Success',
                'data' => $Kontrasepsi
            ], 200);
        }

        return response([
            'message' => 'Kontrasepsi Not Found',
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
    public function update(Request $request, $id) //method update atau mengubah sebuah data Kontrasepsi
    {
        $Kontrasepsi = Kontrasepsi::find($id);
        if(is_null($Kontrasepsi)){
            return response([
                'message' => 'Kontrasepsi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'kontrasepsi' => 'required|alpha_spaces',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $Kontrasepsi->kontrasepsi = $updateData['kontrasepsi'];
        $Kontrasepsi->jenis = $updateData['jenis'];
        $Kontrasepsi->harga = $updateData['harga'];

        if($Kontrasepsi->save()){
            return response([
                'message' => 'Update Kontrasepsi Success',
                'data' => $Kontrasepsi
            ], 200);
        }

        return response([
            'message' => 'Update Kontrasepsi Failed',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //method delete atau menghapus sebuah data Kontrasepsi
    {
        $Kontrasepsi = Kontrasepsi::find($id);

        if(is_null($Kontrasepsi)){
            return response([
                'message' => 'Kontrasepsi Not Found',
                'data' => 'null'
            ], 404);
        }

        if($Kontrasepsi->delete()){
            return response([
                'message' => 'Delete Kontrasepsi Success',
                'data' => $Kontrasepsi
            ], 200);
        }

        return response([
            'message' => 'Delete Kontrasepsi Failed',
            'data' => 'null'
        ], 400);
    }
}
