<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all cars from database
        //return view all cars , carsdata
        //select.*.from cars;
        $classes= Classe::get();
        return view ('classes',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('add_class');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //   dd($request);
    // $classname= 'roses';
    // $capacity= 20;
    // $is_fulled= true;
    // $price= 2000;
    // $time_from=8;
    // $time_to=3;
   


Classe::create([
         'classname'=>$request->classname,
            'capacity'=>$request->capacity,
            'is_fulled'=>isset($request->is_fulled),
            'price'=>$request->price,
            'time_from'=>$request->time_from,
            'time_to'=>$request->time_to,

    ]);
    
    return "Data added successfully";
        }



    /**
     * Display the specified resource.
     */
     function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
     function edit(string $id)
    {
        $classe= Classe::findOrFail($id);
        return view('edit_class', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     */
     function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     function destroy(string $id)
    {
        //
    }
}
