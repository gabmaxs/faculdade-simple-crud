<?php

require_once "../../vendor/autoload.php";

use App\Provider;

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
    "cnpj" => $_POST["cnpj"],
    "email" => $_POST["email"],
    "phone" => $_POST["phone"],
    "address" => $_POST["address"]
];


$provider = new Provider($data);
$provider = $provider->save();
if(!empty($provider)) {

    http_response_code(201);
    echo json_encode($provider);
}
else {
    http_response_code(500);
    echo json_encode(["message" => "Internal Error"]);
}
