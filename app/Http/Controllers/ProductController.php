<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\Common;

class ProductController extends Controller
{
    use Common;

    public function index()
    {
        $products = Product::latest()->take(3)->get();
    
        return view('home', compact('products'));
        
        $products=Product::get();
        return view ('products',compact('products'));
    }
    
    

    public function create()
    {
        $products = Product::all(); 
        return view('add_product', compact('products')); 
       }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data['published'] = $request->has('published');
        $data['image'] = $this->uploadFile($request->image, 'assets/images');


        Product::create($data);

        return redirect()->route('products.index');
    }

    public function edit(string $id)
    {
        //get data of [product] to be updated

  $product = Product::find($id); // Fetch the product data
  if (!$product || empty($product->title)) {
    // Handle missing or empty title
    return redirect()->back()->with('error', 'product title is missing');
}


  return view('edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $this->uploadFile($request->image, 'assets/images');
    }
        $data['published']= isset($request->published);
        Product::where('id', $id)->update($data);

    return redirect()->route('products.index');
}

// public function destroy(Product $car): RedirectResponse
// {
//     $product->delete(); 
//     return redirect()->route('products.index');
// }
// public function showDeleted(){
//     $products=Product::onlyTrashed()->get();
//     return view ('deletedproducts', compact('products'));
// }
// public function restore(string $id){
//     Product::where('id',$id)->restore();
//     return redirect()->route('products.showDeleted');

// } 
// public function forceDelete(string $id)
// {
//     Product::where('id', $id)->forceDelete();
//     return redirect()->route('products.index');
// }

// public function upload(Request $request){
//     $file_extension = $request->image->getClientOriginalExtension();
//     $file_name = time() . '.' . $file_extension;
//     $path = 'assets/images';
//     $request->image->move($path, $file_name);
//    $data['published']= isset($request->published);
//    $data['image']=$file_name;
//     Product::create($data);
//     return redirect()->route('products.index');

// }
}