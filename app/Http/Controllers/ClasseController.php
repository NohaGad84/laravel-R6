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
    public function store(Request $request) {
        $data = $request->validate([
            'classname' => 'required|string',
            'capacity' => 'required|integer|min:0',
            'is_fulled' => 'boolean', // Adjust if checkbox doesn't submit a value by default
            'price' => 'required|numeric|min:0',
            'time_from' => 'required|date_format:Y-m-d H:i:s', // Include time for time field
            'time_to' => 'required|date_format:Y-m-d H:i:s',
        ]);
    
        Log::info('Data to be inserted:', $data);

            Classe::create($data);
            return redirect()->route('classes.index')->with('success', 'classe created successfully');
        
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
    public function update(Request $request, Classe $classe)
{
    $data = $request->validate([
        'classname' => 'required|string', // Remove unique rule if necessary
        'capacity' => 'required|integer|min:0|max:100',
        'is_fulled' => 'boolean',
        'price' => 'required|numeric|min:0',
        'time_from' => 'required|date_format:Y-m-d H:i:s',
        'time_to' => 'required|date_format:Y-m-d H:i:s',
    ]);

    $classe->update($data);

    return redirect()->route('classes.index')->with('success', 'Class updated successfully');
}
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
    public function restore(string $id){
        Classe::where('id',$id)->restore();
        return redirect()->route('classes.showDeleted');

    }
    public function forceDelete(string $id)
{
    Classe::where('id', $id)->forceDelete();
    return redirect()->route('classes.index');
}
}