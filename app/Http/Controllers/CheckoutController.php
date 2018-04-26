<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Session;
use Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::content()->count() == 0)
        {
            Session::flash('info','Your cart is still empty. do some shopping');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {
        //dd(request()->all());

        Stripe::setApiKey("sk_test_YDuZl3FDL54A06ISguvnMicl");
        
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        
        
        // Charge the user's card:
        $charge = Charge::create(array(
          'amount' => Cart::total()*100,
          'currency' => 'usd',
          'description' => 'Example charge',
          'source' => request()->stripeToken
        ));

        Session::flash('success','purchase successfully.wait for email');

        Cart::destroy();

        //email sending before redirect to home page
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccess);
        return redirect('/');
    }
}
