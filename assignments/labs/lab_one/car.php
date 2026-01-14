<?php 
    declare(strict_types=1);
    //Create a PHP file called car.php. In this file, create a class to represent a car. 
    class Car {
        //Properties should include make, model and year and include a method to return this information. 
        public string $make;//make is going to be a word, therefore string data type
        public string $model;//model is also a word, therefore string data type
        public int $year;//year is a number, therefore integer data type

        public function __construct(string $make, string $model, int $year)
        {
            $this->make = $make;
            $this->model = $model;
            $this->year = $year;
        }
        public function getCarInfo(): string
        {
            return "Car Make: {$this->make}, Model: {$this->model}, Year: {$this->year}";
        }
    }

?>