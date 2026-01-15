<?php 
    declare(strict_types=1);
    require_once "connect.php";
    require "header.php";//header goes at the top 
    echo "<p> Follow the instructions outlined in instructions.txt to complete this lab. Good luck & have fun!😀 </p>";
    
    include "car.php";//include or require seem fine here. I suppose it comes down to whether you want a fatal error if the file is missing. I don't so I'm using include.
    //Create an instance of the Car class and display its information using the method you created.
    $myCar = new Car("Toyota", "Camry", 2020);//can make as many instances as I want, each time it will call the constructor, and spit out some html formatted info. Uses the strings typed here as data for the constructor to format, order matters.
    echo $myCar->getCarInfo();
    $myCar = new Car("Ford", "Mustang", 1969);
    echo $myCar->getCarInfo();
    $myCar = new Car("Honda", "Civic", 2015);
    echo $myCar->getCarInfo();
    // $myCar = new Car("Honda", 2015, "Civic"); this is invalid since the order is string, string, int as per the constructor
    require "footer.php";//footer goes at the bottom
?> 