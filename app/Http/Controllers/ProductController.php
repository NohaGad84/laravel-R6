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
    }
    

    public function create()
    {
        return view('add_product');
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
}