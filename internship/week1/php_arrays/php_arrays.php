<?php
// Indexed arrays - Arrays with a numeric index
// Associative arrays - Arrays with named keys
// Multidimensional arrays - Arrays containing one or more arrays

echo "INDEX ARRAYs<br>";

$cars = array("Volvo", "BMW", "Toyota");
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".<br><br>";

echo "Associative Arrays<br>";

$age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");
echo "Peter is " . $age['Peter'] . " years old.<br><br>";

echo "Loop Through an Associative Array<br>";

$age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");

foreach ($age as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br><br>";
}

echo "MultiDimensional Arrays<br>";

$cars = array(
    array("Volvo", 22, 18),
    array("BMW", 15, 13),
    array("Saab", 5, 2),
    array("Land Rover", 17, 15)
);

echo $cars[0][0] . ": In stock: " . $cars[0][1] . ", sold: " . $cars[0][2] . ".<br><br>";
echo $cars[1][0] . ": In stock: " . $cars[1][1] . ", sold: " . $cars[1][2] . ".<br><br>";
echo $cars[2][0] . ": In stock: " . $cars[2][1] . ", sold: " . $cars[2][2] . ".<br><br>";
echo $cars[3][0] . ": In stock: " . $cars[3][1] . ", sold: " . $cars[3][2] . ".<br><br>";


for ($row = 0; $row < 4; $row++) {
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $cars[$row][$col] . "</li>";
    }
    echo "</ul>";
}

?>