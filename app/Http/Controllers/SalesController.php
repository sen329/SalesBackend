<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesData;
use DB;
use Exception;

class SalesController extends Controller
{
    protected $sales;

    public function __construct(SalesData $sales)
    {
        $this->sales = $sales;
    }

    public function all()
    {   
        $sales=$this->sales->all();
        return response()->json($sales,200);
    }

    public function find($id)
    {
        $sales = $this->sales->findOrFail($id);
        return $sales;
    }

    public function create(Request $request)
    {
        $sales = [
            "SalesName"=>$request->SalesName,
            "CustomerName"=>$request->CustomerName,
            "CustomerAddress"=>$request->CustomerAddress,
            "CustomerContact"=>$request->CustomerContact,
            "ProductUsedId"=>$request->ProductUsedId,
            "ProductQuantity"=>$request->ProductQuantity,
            "ProposedPrice"=>$request->ProposedPrice,
            "by_userId"=>$request->user()->id,
            "name"=>$request->user()->name
        ];
        try{
            $sales = $this->sales->create($sales);
            return response()->json($sales,200);
        }
        catch(Exception $ex){
            return response($ex);
        }
    }
    
    public function getProduct($id){
            $sales = SalesData::findOrFail($id);
            $sales->product;
            return $sales;
    }

    public function allSales(){
        $sales->$this->$sales->all();
        return response()->json($sales,200);
    }
    public function getUser($id){
        $sales = SalesData::findOrFail($id);
        $sales->user;
        return $sales;
    }
    
    public function showAllData($id){
        try{
            $sales = $this->sales->where('sales_data.id','=',$id)->
                join('products','products.id','=','sales_data.ProductUsedId')
                ->select(DB::Raw('sales_data.id,sales_data.SalesName,sales_data.CustomerName,
                sales_data.CustomerAddress,sales_data.CustomerContact,
                products.id AS ProductUsedId, products.name AS ProductName, products.productcode AS ProductCode,
                sales_data.ProductQuantity,sales_data.ProposedPrice, products.price AS ProductPrice,
				((sales_data.ProposedPrice-products.price)/sales_data.ProposedPrice*100) as Margin,
                sales_data.name, sales_data.Accepted'))
                ->first();
                return $sales;
        }catch (Exception $ex) {
            echo $ex;
            return response('Failed', 400);
        }
    }

    public function findByID($id){
        $sales = SalesData::with('orders')->findOrFail($id);
        return $sales;
    }

    public function findByName($name){
        $sales = SalesData::with('orders')->where('name',$name)->get();
        return $sales;
    }

    public function mySales($by_userId){
        $sales = SalesData::with('orders')->where('by_userId',$by_userId)->get();
        return $sales;
    }

}
