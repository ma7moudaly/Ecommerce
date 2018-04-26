<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'        => 'required',
            'image'       => 'required|image',
            'price'       => 'required',
            'description' => 'required'
        ]);

        $product = new Product;

        if($request->hasFile('image'))
        {
            $image=$request->image;
            $image_new_name= time().$image->getClientOriginalName();
            $image->move('uploads/products/',$image_new_name);
            $product->image = 'uploads/products/'.$image_new_name; //save image field in db
            
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        
        $product->save();

        Session::flash('success','Product created successfully.');

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')->with('product',$product);
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
        $this->validate($request,[
            'name'        => 'required',
            'price'       =>'required',
            'image'       => 'required|image',
            'description' =>'required'
        ]);

        $product =Product::find($id);

        if($request->hasFile('image'))
        {
            $image=$request->image;
            $image_new_name= time().$image->getClientOriginalName();
            $image->move('uploads/products/',$image_new_name);
            $product->image = 'uploads/products/'.$image_new_name; //save image field in db
            
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        
        $product->save();

        Session::flash('success','Product updated successfully.');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
         //remove image from site before remove product
        if(file_exists($product->image))
        {
            unlink($product->image);
        }

        $product->delete();

        Session::flash('success','Product deleted.');

        return redirect()->back();

    }
}
