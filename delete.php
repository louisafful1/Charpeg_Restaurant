<?php
// Connect to your database
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Perform the deletion in the database
    $deleteQuery = "DELETE FROM transactions WHERE id = $id";
    $result = mysqli_query($connection, $deleteQuery);

    if ($result) {
        echo 'Record deleted successfully';
    } else {
        echo 'Error deleting record: ' . mysqli_error($connection);
    }
}
?>
