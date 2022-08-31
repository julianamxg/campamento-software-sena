<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootCampResource;
use App\Http\Resources\BootCampCollection;


class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //metodo json:
        //parametros: 1. data a enviar al client
        //              2. Codigo status http
        return response()->json( new BootcampCollection(Bootcamp::all())
                                , 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        //1. Traer el payload 
        //2. Crea el nuevo bootcamp
        return response()->json([
                                "success" => true,
                                 "data" => new BootcampResource( 
                                        Bootcamp::create($request->all())), 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
                                    "success" => true,
                                    "data" => new BootcampResource(Bootcamp::find($id))
       ], 200);
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
       //1. localizar  el bootcamp con id
       $b = Bootcamp::find($id);
        // actualizar
        $b->update($request->all());

        return response()->json( [ "success"=>true,
                                    "data"=> new BootcampResource ($b)
                                 ]  , 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $b=Bootcamp::find($id);
       $b->delete();
       return response()->json( [ "success"=>true,
      
                                 "data"=> $b
                                 ], 200);
    }
}
