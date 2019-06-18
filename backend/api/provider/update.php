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

$id = $_POST['id'];

$provider = new Provider($data);

if(!$provider->find($id)){
    http_response_code(404);
    echo json_encode(["message" => "Not Found"]);
    exit;
}

$provider = $provider->save($id);
if(!empty($provider)) {
    http_response_code(200);
    echo json_encode($provider);
}
else {
    http_response_code(500);
    echo json_encode(["message" => "Internal Error"]);
}
