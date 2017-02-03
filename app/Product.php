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

    /**
     * @param int $quantityToBeRemoved number of itens to be decreased from stock
     */
    public function removeFromStock($quantityToBeRemoved)
    {
        $this->stockQuantity = $this->stockQuantity - $quantityToBeRemoved;
        $this->save();
    }

}
