<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{   
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = ['price'];
    protected $guarded =[];

    public function getSales()
    {
    return $this->hasMany('App\SalesData','id','ProductUsedId');
    }
}
