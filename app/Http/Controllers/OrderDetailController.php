<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use App\product;
use App\SalesData;
use Exception;
use DB;

class OrderDetailController extends Controller
{
    protected $order;
    protected $sales;

    public function __construct(OrderDetail $order, SalesData $sales)
    {
        $this->order = $order;
        $this->sales = $sales;
    }

    public function create(Request $request){
        $sales = [
            "SalesName"=>$request->SalesName,
            "CustomerName"=>$request->CustomerName,
            "CustomerAddress"=>$request->CustomerAddress,
            "CustomerContact"=>$request->CustomerContact,
            "by_userId"=>$request->user()->id,
            "name"=>$request->user()->name
        ];
        DB::beginTransaction();
        try{
            $sales = $this->sales->create($sales);
            $orderDetailsArr = [];
            foreach ($request->input('product_id') as $key => $value) {
            $product = Product::find(
                $value
            );
            $orderDetailsArr[] = new OrderDetail([
                'product_id'  => $value,
                'ProductCode' => $product->productcode,
                'ProductPrice'   => $product->price,
                'ProposedPrice'  => $request->input('ProposedPrice.' . $key),
                'Quantity' => $request->input('Quantity.'.$key)
            ]);
        }

        $sales->orders()->saveMany($orderDetailsArr);
        DB::commit();
        return SalesData::with('orders')->find($sales->id);
        }
        catch(Exception $ex){
            DB::rollback();
            return response($ex);
        }

        
    }

    public function all()
    {   
        $sales=SalesData::with('orders')->get()->toArray();
        return $sales;
    }

    public function find($id)
    {
        $sales = SalesData::with('orders')->findOrFail($id);
        return $sales;
    }
    
    public function getAllData($id)
    {
        $sales = SalesData::with('orders')->findOrFail($id);
        return $sales;
    }

}
