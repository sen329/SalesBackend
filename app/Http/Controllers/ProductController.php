<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use DB;
use Exception;

class ProductController extends Controller
{
    protected $product;

    public function __construct(product $product)
    {
        $this->product = $product;
    }

    public function getItem($id)
    {
        $product = $this->product->findOrFail($id);
        return response()->json($product,200);
    }

    public function update(Request $request, $id)
    {   
      $product = product::findOrFail($id);
      $product->price = $request->price;
      $product->save();
      return response()->json($product,200);
    }
    public function all()
    {
        $product = $this->product->all();
        return response()->json($product,200);
    }
}
