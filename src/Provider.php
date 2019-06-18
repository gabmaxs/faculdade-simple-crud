<?php

namespace App;

use App\Connection;
use App\AbstractModel;

class Provider extends AbstractModel {
    protected $table_name = "providers";
    protected $fillable = [
        'name', 'cnpj', 'email', 'phone', 'address'
    ];

}