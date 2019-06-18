<?php

namespace App;

use App\Connection;
use App\AbstractModel;

class Employee extends AbstractModel {
    protected $table_name = "employees";
    protected $fillable = [
        'name', 'email', 'password', 'address', 'cpf', 'salary'
    ];

}
