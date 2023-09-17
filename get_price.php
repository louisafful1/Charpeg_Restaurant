<?php
// get_price.php - This script will handle the AJAX request and return the price for the selected food item.
include "include/database.php";

if (isset($_GET['food_item'])) {
    $selectedItem = $_GET['food_item'];

    $sql = "SELECT price FROM `food` WHERE food = '$selectedItem'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['price'];
    } else {
        echo "0"; // Or any default value if the item is not found.
    }
} else {
    echo "Error: No food item selected.";
}
