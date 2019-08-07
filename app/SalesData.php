<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{   
    public $timestamps = false;
    protected $table = 'sales_data';
    protected $fillable = ['SalesName', 'CustomerName','ContactPerson','CustomerAddress','Postcode','CustomerContact','by_userId','branch','warehouse','nolang'];
    protected $guarded =[];
    protected $appends = [
        'margin'
    ];

    public function orders()
    {
        return $this->hasMany('App\OrderDetail','sales_id');
    }

    public function margin() {
        return $this->product()->select(DB::raw('(ProposedPrice - ProductPrice)/ProposedPrice*100'));
    }

    public function getMarginAttribute() {
        return $this->orders->sum->margin/$this->orders()->count();
    }
}
