<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;
use App\Http\Controllers\BaseController;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->sendResponse(new CourseCollection(Course::all()));
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
            return $this->sendResponse(new CourseResource( 
              Course::create($request->all())), 201);
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
            $course = Course::find($id);
            //2. en caso de que el Review no exista
            if(!$course){
                return $this->sendError("course with id: $id not found", 400);
            }
            return $this->sendResponse(new CourseResource($course));
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
       $b = Course::find($id);
        // actualizar
        $b->update($request->all());

        if(!$b){
            return $this->sendError("Course with id: $id not found", 400);
        }
        return $this->sendResponse(new CourseResource($b));
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
            $b=Course::find($id);
            $b->delete();
       if(!$b){
            return $this->sendError("Course with id: $id not found", 400);
        }
       
        return $this->sendResponse(new CourseResource($b));
        } catch (\Throwable $th) {
            return $this->sendError('Server error', 500);
        }
    }
}
