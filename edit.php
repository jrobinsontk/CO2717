<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
	<!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="Home.php">Oakwood</a>
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
<?php
// Check to see if the server has recieved a POST request
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Include the connection script
	include 'config.php';

    // Copy the GET and POST data to variables
    $id = $_GET['id'];
    $un = $_POST['username'];
    // Write, prepare, and bind the UPDATE query
	$updatequery ="UPDATE users SET username=? WHERE ID=?";
    $stmt = $link->prepare($updatequery);
    $stmt->bind_param('ss', $un, $id );
	
    // Execute the prepared statement
    if (!$stmt->execute()) 
    {
        echo "Error: ".$link->error;
    }
    else 
    {
        echo "<p>Record updated successfully</p>";
        echo "<a href=\"upload.php\">display</a>";
    } 
    $link->close();
}
else
// Else the record has not been edited yet so we need to present the user with the current record
{
    // Include the connection script
	include 'config.php';
    
    // Write, prepare, and bind the SELECT query
    $selectquery = "SELECT * from users WHERE ID=?";
    $stmt = $link->prepare($selectquery);
    $stmt->bind_param('s', $_GET['id']);
    // Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();
	$user = $result->fetch_assoc();
    // Copy the record id from GET to a variable
    $id = $_GET['id'];
    // Copy the retreived row data to variables
    $un = $user['username'];
    
?>
<div class="wrapper">
	<h1>Edit Username:</h1>
    <!-- pulls the id of the user from the URL-->
    <form action="edit.php?id=<?php $id; ?>" method="POST" >
        <label for="username">username: </label>
        <input  type="text" id="username" name="username" value="<?php echo $un; ?>"/><br>
        <br>
        <label for="submit">Submit: </label>
        <input type="submit" id="submit" class="btn btn-primary"  name="submit" value="submit"/>
    </form>	
</div>
<?php  
}
?>
</body>
</html>

