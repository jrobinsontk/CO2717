<?php
// Include the connection script
    include 'connect.php';
    // Write the query, prepare, and bind values
    $deletequery = "DELETE FROM users WHERE ID=?";
    $stmt = $mysqli->prepare($deletequery);
    $stmt->bind_param('s', $_GET['id']);
    // Execute prepared statement
    $stmt->execute();
    // Redirect the user
    header("location: display.php");
?>