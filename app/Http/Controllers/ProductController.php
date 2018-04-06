<?php

namespace App\Http\Controllers;

use App\models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $products;

    /**
     * @return mixed
     */
    public function __construct(Products $products)
    {
        $this->products = $products;
    }
    //
    public function search(Request $request){
        $product = $this->products->whereRaw("name like "."'%".$request['name']."%'"." or producer like "."'%".$request['name']."%'")->get();
        return response()->json($product, 200);
    }
}
