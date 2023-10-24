<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Model-Year: 2099");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/cars.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Car($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->brand = $data->brand;
    $item->model = $data->model;
    $item->model_year = $data->model_year;
    $item->trim = $data->trim;
    $item->manufactured = date('Y-m-d H:i:s');
    
    if($item->createCar()){
        echo 'Car created successfully.';
    } else{
        echo 'Car could not be created.';
    }
?>