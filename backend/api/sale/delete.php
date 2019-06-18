<?php

require_once "../../vendor/autoload.php";

use App\Sale;

header("Access-Control-Allow-Origin: GET");
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


$sale = new Sale();;
if($sale->delete($_POST['id'])) {
    http_response_code(200);
    echo json_encode(["message" => "Success"]);
}
else {
    http_response_code(404);
    echo json_encode(["message" => "Not Found"]);
}
