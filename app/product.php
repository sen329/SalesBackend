<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{   
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = ['name','productcode','price'];
    protected $guarded =[];

    public function order()
    {
    return $this->hasMany('App\OrderDetail','product_id');
    }
}
