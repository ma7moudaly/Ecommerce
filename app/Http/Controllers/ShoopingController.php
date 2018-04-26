<?php

namespace App\Http\Controllers;

use Session;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShoopingController extends Controller
{
    public function add_to_cart()
    {

      //pdt_id = product_id -->from form in index.blade.php  
      $product = Product::find(request()->pdt_id);

      //add to cart
      $CartItem = Cart::add([
         'id' => $product->id,
         'name' => $product->name,
         'price' => $product->price,
         'qty'   =>request()->qty
      ]);

      //to can connect to model throw Cart,to can show image in cart.blade.php
      Cart::associate($CartItem->rowId,'App\Product');
     // dd(Cart::content());

     Session::flash('success','product added to cart');

     return redirect()->route('cart');

    }

    public function cart()
    {
        //Cart::destroy();
        return view('cart');
    }

    public function cart_delete($id)
    {
      Cart::remove($id);

      Session::flash('success','product removed from cart');
      
      return redirect()->back();
    }

    public function incr($id,$qty)
    {
        Cart::update($id ,$qty + 1 );

        Session::flash('success','product Quantity updated');

        return redirect()->back();

    }

    public function decr($id,$qty)
    {
        Cart::update($id ,$qty - 1 );

        Session::flash('success','product Quantity updated');

        return redirect()->back();

    }

    public function rapid_add($id)  
    {
        $product = Product::find($id);
        
              $CartItem = Cart::add([
                 'id' => $product->id,
                 'name' => $product->name,
                 'price' => $product->price,
                 'qty'   =>1
              ]);
        
              //to can connect to model throw Cart,to can show image in cart.blade.php
              Cart::associate($CartItem->rowId,'App\Product');
             // dd(Cart::content());

             Session::flash('success','product added to cart');
        
             return redirect()->route('cart');
    }
    

}
