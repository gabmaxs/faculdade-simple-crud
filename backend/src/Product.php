<?php

namespace App;

use App\Connection;
use App\AbstractModel;

class Poduct extends AbstractModel {
    protected $table_name = "products";
    protected $fillable = [
        'name', 'quantity', 'price', 'provider_id'
    ];

}