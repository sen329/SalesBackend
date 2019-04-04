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
    public function getNonConsumables()
    {
        $product = DB::select('select * from products where type = "Non-Consumable"');
        return response()->json($product,200);
    }

    public function getConsumables()
    {
        $product = DB::select('select * from products where type = "Consumable"');
        return response()->json($product,200);
    }

    public function getItemId($id)
    {
        $product = $this->product->findOrFail($id);
        return response()->json($product,200);
    }

    public function all()
    {
        $product = $this->product->all();
        return response()->json($product,200);
    }
}
