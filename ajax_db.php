<?php
include "include/database.php";

 //General post request to handle all ajax
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){ //general post request to handle all ajax
   
   // Handling the delete button in the table
    if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Perform the deletion in the database
    $deleteQuery = "DELETE FROM transactions WHERE id = $id";
    $result = mysqli_query($connection, $deleteQuery);

    if ($result) {
        echo 'Record deleted successfully';
    } else {
        echo 'Error deleting record: ' . mysqli_error($connection);       
    }
} //End of the delete button in the table



// Handling the edit button
if (isset($_POST['edit'])){

$edit = $_POST['edit'];

$select = "SELECT quantity FROM transactions where id = $edit";
$querySelect =mysqli_query($connection, $select);

if ($querySelect && mysqli_num_rows($querySelect) > 0) {
$row = mysqli_fetch_assoc($querySelect);

// storing the value in a json format
$response = [
    'selectedQuantity' => $row['quantity']
];

// return the json response
header("Content-Type: application/json");
echo json_encode($response);
exit;
}


}


if(isset($_POST['update'])){
    $update = $_POST['update'];
    $currentQuantityValue = $_POST['currentQuantityValue'];
echo   $currentQuantityValue;
    $updateQuantity = mysqli_query($connection, "UPDATE transactions SET quantity = '$currentQuantityValue' WHERE id=$update");
    if ($updateQuantity) {
        echo "Updated successfully";
    } else {
        echo 'Error deleting record: ' . mysqli_error($connection);       
    }


}


}
?>
