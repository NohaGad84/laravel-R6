<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use App\Traits\Common;
use App\Models\Category;

class CarController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all cars from database
        //return view all cars , carsdata
        //select.*.from cars;
        // $cars = Car::get();
        $cars = Car::with('category')->get();

        // dd($cars);

        return view('cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
{
    $car = new Car();  // Create an empty Car object

}
$categories = Category::all();
    return view('add_car', compact('categories'));

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
        'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
'category_id' => 'required|integer|exists:categories,id', 
    ]);
    $data['published']= isset($request->published);

    
    $data['image'] = $this->uploadFile($request->image, 'assets/images/cars');
    Car::create($data);

    return redirect()->route('cars.index');
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $car = Car::findOrFail($id);
    $car['image']='assets/images/cars/'.$car['image'];
    $category = Category::findOrFail($car['category_id']);
  return view('car_details', compact('car','category'));
     
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get data of car to be updated

        $car = Car::findOrFail($id);
        $categories = Category::all();
        $categories = Category::select('id','category_name')->get(); // Select all categories for better performance

        return view('edit_car', compact('car','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $data = $request->validate([
        'cartitle' => 'required|string',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'category_id' => 'required|integer|exists:categories,id',  
   ]);

    $car = Car::findOrFail($id);

    if ($request->hasFile('image')) {
        $data['image'] = $this->uploadFile($request->image, 'assets/images/cars');
    }

    $data['published'] = isset($request->published);
    $car->update($data);
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
       $data['published']= isset($request->published);
       $data['image']=$file_name;
        Car::create($data);
        return redirect()->route('cars.index');

    }
}
