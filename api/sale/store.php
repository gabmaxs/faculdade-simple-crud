<?php

require_once "../../vendor/autoload.php";

use App\Sale;

header("Access-Control-Allow-Origin: POST");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] != "POST"){
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}
if(!isset($_POST) && empty(!$_POST)){
    http_response_code(400);
    echo json_encode(["message" => "Bad Request"]);
    exit;
}

$data = [
    "data" => $_POST["data"],
    "value" => $_POST["value"],
    "employee_id" => $_POST["employee_id"]
];


$sale = new Sale($data);
$sale = $sale->save();
if(!empty($sale)) {

    http_response_code(201);
    echo json_encode($sale);
}
else {
    http_response_code(500);
    echo json_encode(["message" => "Internal Error"]);
}
