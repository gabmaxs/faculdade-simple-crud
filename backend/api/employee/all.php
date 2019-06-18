<?php

require_once "../../vendor/autoload.php";

use App\Employee;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] != "GET"){
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}


$employee = new Employee();
$employees = $employee->all();
if(!empty($employees)) {

    http_response_code(200);
    echo json_encode($employees);
}
else {
    http_response_code(404);
    echo json_encode(["message" => "No employees found"]);
}
