<?php

require_once "../../vendor/autoload.php";

use App\Product;

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
    "name" => $_POST["name"],
    "quantity" => $_POST["quantity"],
    "price" => $_POST["price"],
    "provider_id" => $_POST["provider_id"]
];

$id = $_POST['id'];

$product = new Product($data);

if(!$product->find($id)){
    http_response_code(404);
    echo json_encode(["message" => "Not Found"]);
    exit;
}

$product = $product->save($id);
if(!empty($product)) {
    http_response_code(200);
    echo json_encode($product);
}
else {
    http_response_code(500);
    echo json_encode(["message" => "Internal Error"]);
}
