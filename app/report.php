<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['sales_id','SalesName', 'branch','CustomerName','CustomerAddress','CustomerContact','by_userId', 'product_id','ProductName','ProductCode','ProductPrice','LKPP','ProposedPrice','Quantity','Margin','Total','Accepted','RecommendedPrice','TotalRecommendedPrice','created_at','updated_at'];
    protected $guarded =[];
    protected $appends = [
        'margin',
        'totalproposedprice',
        'totalrecommendedprice',
    ];

    protected $hidden = ['sales_id','order_id','margin','totalproposedprice'];

    public function sales(){
        return $this->belongsTo('App\SalesData','sales_id');
    }

    public function product(){
        return $this->belongsTo('App\product','product_id');
    }

    public function getMarginAttribute() {
        return (($this->ProposedPrice-$this->ProductPrice)/$this->ProposedPrice)*100;
    }

    public function getTotalproposedpriceAttribute(){
        return $this->ProposedPrice*$this->Quantity;
    }

    public function getTotalrecommendedpriceAttribute(){
        return $this->RecommendedPrice*$this->Quantity;
    }

}
