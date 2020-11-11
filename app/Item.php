<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // allow
    protected $fillable = ['part_number', 'name', 'description', 'stock', 'price'];

    // not allow
    // protected $guarded;

    // public function orderdetail(){
    //     return $this->hasMany(Orderdetail::class);
    // }

    public function setPartNumberAttribute($value)
    {
        $this->attributes['part_number'] = strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
