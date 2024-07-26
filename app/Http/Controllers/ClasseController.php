<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
        $classe= Classe::findOrFail($id);
        return view('classe_details', compact('classe')); 
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
$data=[
    'classname'=>$request->classname,
    'capacity'=>$request->capacity,
    'is_fulled'=>isset($request->is_fulled),
    'price'=>$request->price,
    'time_from'=>$request->time_from,
    'time_to'=>$request->time_to,

];
Classe::where('id',$id)->update($data);
return redirect()->route('classes.index');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe): RedirectResponse
    {
        $classe->delete(); 
        return redirect()->route('classes.index');
    }
    public function showDeleted(){
        $classes= Classe::onlyTrashed()->get();
        return view ('deletedclasses', compact('classes'));
    }
}