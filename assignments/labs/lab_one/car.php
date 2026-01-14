<?php 
    declare(strict_types=1);
    //Create a PHP file called car.php. In this file, create a class to represent a car. 
    class Car {
        //Properties should include make, model and year and include a method to return this information. 
        public string $make;//make is going to be a word, therefore string data type
        public string $model;//model is also a word or word + numbers, therefore string data type
        public int $year;//year is a number, therefore integer data type, though technically makes no difference here unless you were using said number in calculations.

        public function __construct(string $make, string $model, int $year)
        {
            $this->make = $make;//make property assigned from constructor parameter
            $this->model = $model;//etc
            $this->year = $year;//etc
        }
        public function getCarInfo(): string //method to return car information as a string
        {
            return "<h3>Vehicle 1</h3><p><b>Car Make:</b> {$this->make}</p><p><b>Model:</b> {$this->model}</p><p><b>Year:</b> {$this->year}</p>";
            //calls the properties and places them in a paragraph to allow multiple cars to be displayed neatly.
        }
    }

?>