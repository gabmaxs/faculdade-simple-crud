<?php

require_once "../../vendor/autoload.php";

use App\Product;

header("Access-Control-Allow-Origin: GET");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] != "GET"){
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}


$product = new Product();
$products = $product->all();
if(!empty($products)) {

    http_response_code(200);
    echo json_encode($products);
}
else {
    http_response_code(404);
    echo json_encode(["message" => "No products found"]);
}
