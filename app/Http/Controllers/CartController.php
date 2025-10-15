<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Since we're using localStorage, we just return the view
        // The cart data will be loaded from localStorage via JavaScript
        return view('cart');
    }
}