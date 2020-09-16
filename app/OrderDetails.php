<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
     protected $table ='oders_detail';
	protected $guarded =[];

	 public function oders()
    {
        return $this->belongsTo('App\OrderModel','order_id');
    }

    public function products()
    {
        return $this->hasOne('App\Products','product_id');
    }}
