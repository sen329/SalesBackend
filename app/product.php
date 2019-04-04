<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    protected $fillable = [];
    protected $guarded =[];

    public function getSales()
    {
    return $this->hasMany('App\SalesData','id','ProductUsedId');
    }
}
