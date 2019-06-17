<?php

include_once "vendor/autoload.php";

use App\Employee;

$em = new Employee();
$t = $em->all();
var_dump($t->fetch());
