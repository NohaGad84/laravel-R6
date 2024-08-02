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
    $cars = Car::all(); // Fetch all cars
    return view('add_car', compact('cars'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'cartitle' => 'required|string', 
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
    $data['published'] = isset($data['published']) ? $data['published'] : false;
    $imagePath = $request->file('image')->store('assets/images');
    
    $data['image'] = $imagePath; // Assign the stored image path to the data array
    Car::create($data);

    return redirect()->route('cars.index')->with('success', 'Car created successfully');
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Fetch the car by id
    $car = Car::findOrFail($id);
    return view('car_details', compact('car'));   
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get data of car to be updated

  $car = Car::find($id); // Fetch the car data
  if (!$car || empty($car->cartitle)) {
    // Handle missing or empty cartitle
    return redirect()->back()->with('error', 'Car title is missing');
}


  return view('edit_car', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
{
    $data = $request->validate([
        'cartitle' => 'required|string',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'published' => 'boolean',
    ]);

    // Retain existing image if no new upload
    if ($request->hasFile('image')) {
        // Handle new upload
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $request->image->move('assets/images', $file_name);
        $data['image'] = 'assets/images/' . $file_name; // Update with new image path
    } else {
        $data['image'] = $car->image; // Keep existing image
    }

    $car->update($data);
    return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
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
    public function restore(string $id){
        Car::where('id',$id)->restore();
        return redirect()->route('cars.showDeleted');

    } 
    public function forceDelete(string $id)
    {
        Car::where('id', $id)->forceDelete();
        return redirect()->route('cars.index');
    }

    public function upload(Request $request){
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'assets/images';
        $request->image->move($path, $file_name);
        return 'Uploaded';
    }
}
