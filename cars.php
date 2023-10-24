<?php
    class Car{

        // Connection
        private $conn;

        // Table
        private $db_table = "Car";

        // Columns
        public $car_id;
        public $brand;
        public $model;
        public $model_year;
        public $trim;
        public $manufactured;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCars(){
            $sqlQuery = "SELECT car_id, brand, model, model_year, trim, manufactured FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCar(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        brand = :brand, 
                        model = :model, 
                        model_year = :model_year, 
                        trim = :trim, 
                        manufactured = :manufactured";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->model=htmlspecialchars(strip_tags($this->model));
            $this->model_year=htmlspecialchars(strip_tags($this->model_year));
            $this->trim=htmlspecialchars(strip_tags($this->trim));
            $this->manufactured=htmlspecialchars(strip_tags($this->manufactured));
        
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":model", $this->model);
            $stmt->bindParam(":model_year", $this->model_year);
            $stmt->bindParam(":trim", $this->trim);
            $stmt->bindParam(":manufactured", $this->manufactured);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleCar(){
            $sqlQuery = "SELECT
                        car_id, 
                        brand, 
                        model, 
                        model_year, 
                        trim, 
                        manufactured
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       car_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->brand = $dataRow['brand'];
            $this->model = $dataRow['model'];
            $this->model_year = $dataRow['model_year'];
            $this->trim = $dataRow['trim'];
            $this->manufactured = $dataRow['manufactured'];
        }        

        // UPDATE
        public function updateCar(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        brand = :brand, 
                        model = :model, 
                        model_year = :model_year, 
                        trim = :trim, 
                        manufactured = :manufactured
                    WHERE 
                        car_id = :car_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->model=htmlspecialchars(strip_tags($this->model));
            $this->model_year=htmlspecialchars(strip_tags($this->model_year));
            $this->trim=htmlspecialchars(strip_tags($this->trim));
            $this->manufactured=htmlspecialchars(strip_tags($this->manufactured));
            $this->car_id=htmlspecialchars(strip_tags($this->car_id));
        
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":model", $this->model);
            $stmt->bindParam(":model_year", $this->model_year);
            $stmt->bindParam(":trim", $this->trim);
            $stmt->bindParam(":manufactured", $this->manufactured);
            $stmt->bindParam(":car_id", $this->car_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCar(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE car_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->car_id=htmlspecialchars(strip_tags($this->car_id));
        
            $stmt->bindParam(1, $this->car_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

