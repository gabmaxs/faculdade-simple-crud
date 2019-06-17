<?php

require_once "../../vendor/autoload.php";

use App\Employee;

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
    "email" => $_POST["email"],
    "password" => $_POST["password"],
    "address" => $_POST["address"],
    "salary" => $_POST["salary"],
    "cpf" => $_POST["cpf"]
];


$employee = new Employee($data);
$employee = $employee->save();
if(!empty($employee)) {

    http_response_code(201);
    echo json_encode($employee);
}
else {
    http_response_code(500);
    echo json_encode(["message" => "Internal Error"]);
}
