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
use App\Exports\reportUsers;

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
                    "branch" =>$data->sales->branch,
                    "CustomerName"=>$data->sales->CustomerName,
                    "CustomerAddress"=>$data->sales->CustomerAddress,
                    "CustomerContact"=>$data->sales->CustomerContact,
                    "by_userId"=>$data->sales->by_userId,
                    "product_id"  => $data->product_id,
                    "ProductName" => $data->ProductName,
                    "ProductCode" => $data->ProductCode,
                    "ProductPrice"   => $data->ProductPrice,
                    "LKPP" => $data->LKPP,
                    "ProposedPrice"  => $data->ProposedPrice,
                    "Margin" => $data->margin,
                    "Total" => $data->totalproposedprice,
                    "Quantity" => $data->Quantity,
                    "Accepted" => $data->Accepted,
                    "RecommendedPrice" => $data->RecommendedPrice,
                    "TotalRecommendedPrice" => $data->totalrecommendedprice,
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

    public function showId($by_userId){
        $report = $this->report->where('by_userId',$by_userId)->get();
        return $report;
    }

    public function export(){
        return Excel::download(new ReportsExport, 'Report.xlsx');
    }

    // public function exportById(){
    //     return (new reportUsers(2))->download('MyReport.xlsx');
    // }

}
