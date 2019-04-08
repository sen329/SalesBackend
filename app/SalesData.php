<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{   
    public $timestamps = false;
    protected $table = 'sales_data';
    protected $fillable = ['SalesName', 'CustomerName','CustomerAddress','CustomerContact','ProductUsedId','ProductQuantity','ProposedPrice','by_userId','name','Accepted'];
    protected $guarded =[];

    public function product()
    {
        return $this->belongsTo('App\product','ProductUsedId');
    }
}
