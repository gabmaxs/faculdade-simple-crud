<?php

namespace App;

use App\Connection;
use App\AbstractModel;

class Sale extends AbstractModel {
    protected $table_name = "sales";
    protected $fillable = [
        'data', 'value', 'employee_id'
    ];

}