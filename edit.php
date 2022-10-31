<!DOCTYPE html>
<html>
<head>
<title>Edit</title>
</head>
<body>
<?php
// Check to see if the server has recieved a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
// Include the connection script
	include 'connect.php';

    // Copy the GET and POST data to variables
    $id = $_GET['id'];
    $fn = $_POST['forname'];
    $sn = $_POST['lastname'];
    $rl = $_POST['role'];
    $ex = $_POST['ext'];
    // Write, prepare, and bind the UPDATE query
	$updatequery ="UPDATE users SET forname=?, lastname=?, role=?, ext=? WHERE ID=?";
    $stmt = $mysqli->prepare($updatequery);
    $stmt->bind_param('sssss', $fn, $ln, $rl, $ex, $id );
	
    // Execute the prepared statement
    if (!$stmt->execute()) 
    {
        echo "Error: ".$mysqli->error;
    }
    else 
    {
        echo "<p>Record updated successfully</p>";
        echo "<a href=\"display.php\">display</a>";
    } 
    $mysqli->close();
}
else
// Else the record has not been edited yet so we need to present the user with the current record
{
    // Include the connection script
	include 'connect.php';
    
    // Write, prepare, and bind the SELECT query
    $selectequery = "SELECT * from users WHERE ID=?";
    $stmt = $mysqli->prepare($selectquery);
    $stmt->bind_param('s', $_GET['id']);
    // Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();
	$user = $result->fetch_assoc();
    // Copy the record id from GET to a variable
    $id = $_GET['id'];
    // Copy the retreived row data to variables
    $fn = $user['forname'];
    $sn = $user['lastname'];
    $rl = $user['email'];
    $ex = $user['ext']
?>
	<h1>Edit record:</h1>
    <!-- Please notice that the primary key is being added to the URL once again within the action, this is vital -->
    <!-- Also please notice that the retrieved record values are being output within the value attribute of the input fields -->
    <form action="edit.php?id=<?php $id; ?>" method="POST" >
        <label for="fname">Forname: </label>
        <input  type="text" id="fname" name="fname" value="<?php echo $fn; ?>"/><br>
        <label for="sname">Surname: </label>
        <input  type="text" id="sname" name="sname" value="<?php echo $sn; ?>"/><br>
        <label for="role">Role: </label>
        <input  type="text" id="role" name="role" value="<?php echo $rl; ?>"/><br>
        <label for="ext">Ext: </label>
        <input  type="password" id="ext" name="ext" value="<?php echo $ex; ?>"/><br>
        <label for="submit">Submit: </label>
        <input type="submit" id="submit" name="submit" value="submit"/>
    </form>	
</div>
</body>
</html>
<?php  
}
?>
