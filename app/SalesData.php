<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{   
    public $timestamps = false;
    protected $table = 'sales_data';
    protected $fillable = ['ProjectClass', 'SalesName', 'CustomerName','CustomerAddress','CustomerContact','ThreeMonths'];
    protected $guarded =[];
}
