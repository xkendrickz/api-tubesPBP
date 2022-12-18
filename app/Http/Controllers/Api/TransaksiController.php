<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index() //method read atau menampilkan semua data Transaksi
    {
        $transaksis = Transaksi::all();

        if(count($transaksis) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksis
            ], 200);
        } //return data semua Transaksi dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400); //return message data course kosong
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //method create atau menambahkan sebuah data Transaksi
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'obat' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $transaksi = Transaksi::create($storeData);
        return response([
            'message' => 'Add Transaksi Success',
            'data' => $transaksi
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //method delete atau menghapus sebuah data Transaksi
    {
        $Transaksi = Transaksi::find($id);

        if(is_null($Transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => 'null'
            ], 404);
        }

        if($Transaksi->delete()){
            return response([
                'message' => 'Delete Transaksi Success',
                'data' => $Transaksi
            ], 200);
        }

        return response([
            'message' => 'Delete Transaksi Failed',
            'data' => 'null'
        ], 400);
    }

	public function destroyAll() //method delete atau menghapus sebuah data Transaksi
    {
        $transaksis = Transaksi::all();

        if(is_null($transaksis)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => 'null'
            ], 404);
        }

        if($transaksis->delete()){
            return response([
                'message' => 'Delete Transaksi Success',
                'data' => $transaksis
            ], 200);
        }

        return response([
            'message' => 'Delete Transaksi Failed',
            'data' => 'null'
        ], 400);
    }
}
