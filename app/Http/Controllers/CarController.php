<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all cars from database
        //return view all cars , carsdata
        //select.*.from cars;
        $cars=Car::get();
        return view ('cars',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('add_car');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    Car::create([
        'cartitle'=>$request->cartitle,
        'description'=>$request->description,
        'price'=>$request->price,
        'published'=>isset($request->published),
]);

        return "Data added successfully";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car= Car::findOrFail($id);
        return view('car_details', compact('car'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get data of car to be updated
        //
        $car= Car::findOrFail($id);
        return view('edit_car', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=[
        'cartitle'=>$request->cartitle,
        'description'=>$request->description,
        'price'=>$request->price,
        'published'=>isset($request->published),
];
        Car::where('id',$id)->update($data);
        return redirect()->route('cars.index');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        $car->delete(); 
        return redirect()->route('cars.index');
    }
    public function showDeleted(){
        $cars=Car::onlyTrashed()->get();
        return view ('deletedcars', compact('cars'));
    }

}
