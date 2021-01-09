<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'user_id', 'total', 'status'];
    protected $dates = ['created_at', 'updated_at'];

    public function items()
    {
        return $this->belongsToMany(Item::class)
        ->withPivot(['id', 'quantity', 'unit', 'discount', 'sub_total'])->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
    
}
