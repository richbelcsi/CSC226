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

    $item->car_id = isset($_GET['car_id']) ? $_GET['car_id'] : die();
  
    $item->getSingleCar();

    if($item->brand != null){
        // create array
        $emp_arr = array(
            "car_id" =>  $item->car_id,
            "brand" => $item->brand,
            "model" => $item->model,
            "model_year" => $item->model_year,
            "trim" => $item->trim,
            "manufactured" => $item->manufactured
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Car not found.");
    }
?>