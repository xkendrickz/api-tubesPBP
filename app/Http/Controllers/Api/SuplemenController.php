<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuplemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $suplemens = Suplemen::all();

        if(count($suplemens) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $suplemens
            ], 200);
        } 

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
    public function store(Request $request) 
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'suplemen' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $suplemen = Suplemen::create($storeData);
        return response([
            'message' => 'Add Suplemen Success',
            'data' => $suplemen
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        $Suplemen = Suplemen::where('id',$id)->get(); 

        if(!is_null($Suplemen)){
            return response([
                'message' => 'Retrieve Suplemen Success',
                'data' => $Suplemen
            ], 200);
        }

        return response([
            'message' => 'Suplemen Not Found',
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
    public function update(Request $request, $id) 
    {
        $Suplemen = Suplemen::find($id);
        if(is_null($Suplemen)){
            return response([
                'message' => 'Suplemen Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'suplemen' => 'required|alpha_spaces',
            'jumlah' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $Suplemen->suplemen = $updateData['suplemen'];
        $Suplemen->jumlah = $updateData['jumlah'];
        $Suplemen->jenis = $updateData['jenis'];
        $Suplemen->harga = $updateData['harga'];

        if($Suplemen->save()){
            return response([
                'message' => 'Update Suplemen Success',
                'data' => $Suplemen
            ], 200);
        }

        return response([
            'message' => 'Update Suplemen Failed',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $Suplemen = Suplemen::find($id);

        if(is_null($Suplemen)){
            return response([
                'message' => 'Suplemen Not Found',
                'data' => 'null'
            ], 404);
        }

        if($Suplemen->delete()){
            return response([
                'message' => 'Delete Suplemen Success',
                'data' => $Suplemen
            ], 200);
        }

        return response([
            'message' => 'Delete Suplemen Failed',
            'data' => 'null'
        ], 400);
    }
}
