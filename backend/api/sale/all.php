<?php

require_once "../../vendor/autoload.php";

use App\Sale;

header("Access-Control-Allow-Origin: GET");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] != "GET"){
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}


$sale = new Sale();
$sales = $sale->all();
if(!empty($sales)) {

    http_response_code(200);
    echo json_encode($sales);
}
else {
    http_response_code(404);
    echo json_encode(["message" => "No sales found"]);
}
