<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{
    public function creating(Product $model){

        $tax = .20;
 
        if ($model->quantity < 10) { $model->price += $model->price * $tax;
        } else if ($model->quantity >= 10) {
            $model->price += $model->price * ($tax / 2);
        }
   
}

}
