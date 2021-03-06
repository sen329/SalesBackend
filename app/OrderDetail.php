<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = true;
    protected $table = 'order_details';
    protected $fillable = ['sales_id', 'product_id','ProductName','ProductCode','ProductPrice','LKPP','ProposedPrice','Quantity','Accepted','RecommendedPrice','stock','Status','created_at','updated_at'];
    protected $guarded =[];
    protected $appends = [
        'margin',
        'totalproposedprice',
        'totalrecommendedprice'
    ];

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
