<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootCampResource;
use App\Http\Resources\BootCampCollection;
use App\Http\Controllers\BaseController;


class BootcampController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->sendResponse(new BootcampCollection(Bootcamp::all()));
        } catch (\Exception $e) {
            return $this->sendError('Server error', 500);
        }
        //metodo json:
        //parametros: 1. data a enviar al client
        //              2. Codigo status http
       // return response()->json( new BootcampCollection(Bootcamp::all())
         //                       , 200);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        try {
          return $this->sendResponse(new BootcampResource( 
            Bootcamp::create($request->all())), 201);
        } catch (\Exception $th) {
            return $this->sendError('Server error', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
        //1. Encontrar el bootcamp por id
        $bootcamp = Bootcamp::find($id);
        //2. en caso de que el bootcamp no exista
        if(!$bootcamp){
            return $this->sendError("bootcamps with id: $id not found", 400);
        }
        return $this->sendResponse(new BootcampResource($bootcamp));
    }catch(\Exception $e){
        return $this->sendError('Server error', 500);
        }
       
        
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
        try {
            //code...
       
       //1. localizar  el bootcamp con id
       $b = Bootcamp::find($id);
        // actualizar
        $b->update($request->all());

        if(!$b){
            return $this->sendError("bootcamps with id: $id not found", 400);
        }
        return $this->sendResponse(new BootcampResource($b));
    }
 catch (\Exception $th) {
    return $this->sendError('Server error', 500);
}
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $b=Bootcamp::find($id);
            $b->delete();
       if(!$b){
            return $this->sendError("bootcamps with id: $id not found", 400);
        }
       
        return $this->sendResponse(new BootcampResource($b));
        } catch (\Throwable $th) {
            return $this->sendError('Server error', 500);
        }
      
    }
    }

