<?php
// A constant is an identifier (name) for a simple value. The value cannot be changed during the script.

// A valid constant name starts with a letter or underscore (no $ sign before the constant name).

// Note: Unlike variables, constants are automatically global across the entire script.


define("GREETING", "Hello World");
echo GREETING . "<br><br>";


// Create an Array constant:
echo "Array Constant<br>";
define("cars", [
    "Alfa Romeo",
    "BMW",
    "Toyota"
]);
echo cars[0] . "<br><br>";

//   Constants are Global
//   Constants are automatically global and can be used across the entire script.


define("HELLO", "Hello World");

function myTest()
{
    echo HELLO;
}

myTest();
    ?>