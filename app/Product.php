<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "price", "stockQuantity", "created_at", "updated_at"];

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot("productQuantity", "price");
    }

}
