<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['sales_id','SalesName', 'CustomerName','CustomerAddress','CustomerContact','by_userId','name', 'product_id','ProductName','ProductCode','ProductPrice','ProposedPrice','Quantity','Margin','Total','Accepted','RecommendedPrice','created_at','updated_at'];
    protected $guarded =[];
    protected $appends = [
        'margin',
        'totalproposedprice',
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
}
