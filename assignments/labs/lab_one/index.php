<?php 
    declare(strict_types=1);
    require_once "connect.php";
    require "header.php"; 
    echo "<p> Follow the instructions outlined in instructions.txt to complete this lab. Good luck & have fun!😀 </p>";
    
    include "car.php";
    //Create an instance of the Car class and display its information using the method you created.
    $myCar = new Car("Toyota", "Camry", 2020);
    echo $myCar->getCarInfo();
    $myCar = new Car("Ford", "Mustang", 1969);
    echo $myCar->getCarInfo();
    $myCar = new Car("Honda", "Civic", 2015);
    echo $myCar->getCarInfo();
    require "footer.php";
?> 