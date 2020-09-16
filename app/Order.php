<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='tbl_order';
	protected $guarded =[];
	protected $fillable = [
        'order_id'
    ];
	public function user()
    {
        return $this->belongsTo('App\UserModel','customer_id');
    }
    public function oders_detail()
	{
		return $this->hasMany('App\OrderDetails','order_id');
	}
}
