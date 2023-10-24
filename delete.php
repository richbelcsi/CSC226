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
    
    $item->car_id = $data->car_id;
    
    if($item->deleteCar()){
        echo json_encode("Car deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>