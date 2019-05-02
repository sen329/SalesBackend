<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use DB;
use Exception;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

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
          "ProductNumber" => $request->productcode,
          "Productname" => $request->name,
          "COGS"=> $request->price,
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
          "ProductNumber" => $request->productcode,
          "Productname" => $request->name,
          "COGS"=> $request->price,
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

    private function _import_csv($path, $filename)
    {
        $csv = $path . $filename; 
        //ofcourse you have to modify that with proper table and field names
        $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE your_table FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES (`filed_one`, `field_two`, `field_three`)", addslashes($csv));
        return DB::connection()->getpdo()->exec($query);
    }


public function uploadExcel(){
    Excel::import(new ProductImport, request()->file('file'));
    
    return redirect('/')->with('success', 'All good!');

}
    public function importUpdate()
    {
        $data = Excel::toArray(new ProductImport, request()->file('file')); 
        //dd($data[0]);
        if(count($data[0])){
            foreach ($data[0] as $key => $value) {
                $check =product::where('ProductNumber',$value[0])->exists();
                $data = [
                    "ProductNumber" => $value[0],
                    "Productname" => $value[1],
                    "COGS"=> $value[2],
                ];
                //dd($check, $data);
                if($check){
                    product::where('ProductNumber',$value[0])->update($data);
                }else{
                    $arr[] = $data;
                }
            }

            if(! empty($arr)){
                product::insert($arr);
            }
        }
    }
}
