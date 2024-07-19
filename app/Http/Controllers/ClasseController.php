<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

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
    $classname= 'roses';
    $capacity= '20';
    $is_fulled= true;
    $price= 2000;
    $time_from=8;
    $time_to=3;
    Classe::create([
    'classname'=> $classname,
    'capacity'=>20,
    'is_fulled'=> $is_fulled,
    'price'=> 2000,
    'time_from'=> $time_from,
    'time_to'=> $time_to,

]);
return "Data added successfully";
    }

    /**
     * Display the specified resource.
     */
     function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     function edit(string $id)
    {
        //
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
