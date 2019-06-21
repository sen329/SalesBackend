<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use App\product;
use App\SalesData;
use App\report;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
use Exception;
use DB;


class ReportController extends Controller
{
    protected $order;
    protected $sales;
    protected $report;

    public function __construct(OrderDetail $order, SalesData $sales, report $report)
    {
        $this->order = $order;
        $this->sales = $sales;
        $this->report = $report;
    }

    public function generate(){
        try{
            foreach ($this->order->all() as $data){
                $report = [
                    "sales_id"=>$data->sales_id,
                    "order_id"=>$data->id,
                    "SalesName"=>$data->sales->SalesName,
                    "CustomerName"=>$data->sales->CustomerName,
                    "CustomerAddress"=>$data->sales->CustomerAddress,
                    "CustomerContact"=>$data->sales->CustomerContact,
                    "by_userId"=>$data->sales->by_userId,
                    "name"=>$data->sales->name,
                    "product_id"  => $data->product_id,
                    "ProductName" => $data->ProductName,
                    "ProductCode" => $data->ProductCode,
                    "ProductPrice"   => $data->ProductPrice,
                    "ProposedPrice"  => $data->ProposedPrice,
                    "Margin" => $data->margin,
                    "Total" => $data->totalproposedprice,
                    "Quantity" => $data->Quantity,
                    "Accepted" => $data->Accepted,
                    "RecommendedPrice" => $data->RecommendedPrice,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at
                ];
                if(report::where('order_id','=',$data->id)->exists()){
                    report::where('order_id','=',$data->id)->update($report);
                } else{
                    report::insert($report);
                }
                
            }
            
           
        }

        catch(Exception $ex){
            return response($ex);
        }
    }

    public function showAll(){
        $report = $this->report->all();
        return $report;
    }

    public function export(){
        return Excel::download(new ReportsExport, 'Report.xlsx');
    }

}
