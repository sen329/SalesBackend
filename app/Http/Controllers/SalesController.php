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
            "ProjectClass"=>$request->ProjectClass,
            "SalesName"=>$request->SalesName,
            "CustomerName"=>$request->CustomerName,
            "CustomerAddress"=>$request->CustomerAddress,
            "CustomerContact"=>$request->CustomerContact,
            "ThreeMonths"=>$request->ThreeMonths
        ];
        try{
            $sales = $this->sales->create($sales);
            return response()->json($sales,200);
        }
        catch(Exception $ex){
            return response($ex);
        }
    }
    public function update(Request $request, $id)
    {   
      $sales = SalesData::findOrFail($id);
      $sales->Accepted = $request->Accepted;
      $sales->save();
      return response()->json($sales,200);
        }
}
