<?php
declare(strict_types=1);
//1. Set Up & Start 


//2. Code Commenting 
//inline Commenting
/* 
  Multi-line Commenting
*/

//3. Variables, Data Tyoes, Concatenation, Conditional Statements & Echo



$firstName = "Michael";
$lastName = "Emdin";
$age = 30;
$isStudent = true;

echo "<p>Hello, my name is " . $firstName . " " . $lastName . " and I am " . $age . " years old.</p>";

if ($isStudent) {
    echo "<p>I am a student.</p>";
} 
else {
    echo "<p>I am not a student.</p>";
}
//4. Loosely Typed Language Demo
$num1 = 1; //int
$num2 = 2;   // string

function add($num1, $num2) {
    return $num1 + $num2;
}

echo "<p>The sum is: " . add($num1, $num2) . "</p>";
//5. Strict Types & Types Hints


//6. OOP with PHP 
?>