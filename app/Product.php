<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "price", "stock_quantity", "created_at", "updated_at"];
}
