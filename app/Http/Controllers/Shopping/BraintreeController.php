<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BraintreeController extends ApiController
{

    public function index(){
        return View('shopping.braintree');
    }

    public function checkout(Request $request)
    {
        dd($request->input("payment_method_nonce"));

    }

}