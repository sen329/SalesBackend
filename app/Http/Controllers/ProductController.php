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

    public function create(Request $request)
    {
        $product = [
            "name" => $request->name,
            "productcode" => $request->productcode,
            "price"=> $request->price,
        ];
        //dd($request->all());
        try{
            $product = $this->product->create($product);
            return response()->json($product,200);
        }
            catch(Exception $ex)  {
                return response ($ex);
            }    
    }

    public function update(Request $request, $id)
    {   
      $product = [
          "name" => $request->name,
          "productcode" => $request->productcode,
          "price"=> $request->price,
      ];
      try{
        $this->product->findOrFail($id)->save();
        return response()->json($product,200);
      }
        catch(Exception $ex)  {
            return response ($ex);
        }    
    }
    public function all()
    {
        $product = $this->product->all();
        return response()->json($product,200);
    }
}
