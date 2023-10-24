<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/cars.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Car($db);

    $stmt = $items->getCars();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $carArr = array();
        $carArr["body"] = array();
        $carArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "car_id" => $car_id,
                "brand" => $brand,
                "model" => $model,
                "model_year" => $model_year,
                "trim" => $trim,
                "manufactured" => $manufactured
            );

            array_push($carArr["body"], $e);
        }
        echo json_encode($carArr);
    }


    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>