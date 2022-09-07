<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewCollection;
use App\Http\Controllers\BaseController;

class ReviewController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->sendResponse(new ReviewCollection(Review::all()));
        } catch (\Exception $e) {
            return $this->sendError('Server error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)

    {
        try {
            return $this->sendResponse(new ReviewResource( 
                Review::create($request->all())), 201);
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
            //1. Encontrar el Review por id
            $review = Review::find($id);
            //2. en caso de que el Review no exista
            if(!$review){
                return $this->sendError("Reviews with id: $id not found", 400);
            }
            return $this->sendResponse(new ReviewResource($review));
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
       $b = Review::find($id);
        // actualizar
        $b->update($request->all());

        if(!$b){
            return $this->sendError("Review with id: $id not found", 400);
        }
        return $this->sendResponse(new ReviewResource($b));
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
            $b=Review::find($id);
            $b->delete();
       if(!$b){
            return $this->sendError("Course with id: $id not found", 400);
        }
       
        return $this->sendResponse(new ReviewResource($b));
        } catch (\Throwable $th) {
            return $this->sendError('Server error', 500);
        }
    }
}
