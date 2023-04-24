<?php
// Initialize the session
session_start();
// Include config file
require('config.php');

 
// Check if the user is already logged in, if not then they are redirected to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="home.php">Oakhouse</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="upload.php">Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>

                    </ul>
                </div>
            </div>
            </nav>
            <!-- Page content-->
<div class="container">
	<h1>Display records:</h1>
<?php


// Write and execute the query
$sql = "SELECT ID, username FROM users";
$result = $link->query ($sql);

// Check result
if($result){
if ($result->num_rows > 0) {
	// Output HTML table heading
	echo "<table>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Username</th>";
	echo "</tr>";
	echo "</thead>";
	while($row = $result->fetch_assoc()) 
	{
		// Output data from each row
		echo "<tr>";
		echo "<td>" . $row['username'] . "</td>";
		// Output hyperlinks including primary key to Edit and Delete functions
		echo'<td><a href="edit.php?id=' . $row["ID"] . '">Edit</a></td>';
		echo'<td><a href="delete.php?id=' . $row["ID"] . '">Delete</a></td>';
		echo "</tr>";
	}
	echo "</table>";
	  
} else {
	// Otherwise inform, the user there are no results
    echo "0 results";
}
// Close data connection
$result->close();
$link->close();
}
?>
</div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

