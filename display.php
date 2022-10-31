<!DOCTYPE html>
<head>
<title>Display</title>
</head>
<body>
<?php include 'users.php'?>
<div class="container">
	<h1>Display records:</h1>
<?php
// Include the connection script
include 'connect.php';

// Write and executethe query
$sql = "SELECT ID, forname, lastname, role, ext FROM users";
$result = $mysqli->query ($sql);

// Check result
if($result){
if ($result->num_rows > 0) {
	// Output HTML table heading
	echo "<table>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Forname</th>";
	echo "<th>Surname</th>";
	echo "<th>Role</th>";
	echo "<th>Ext.</th>";
	echo "</tr>";
	echo "</thead>";
	while($row = $result->fetch_assoc()) 
	{
		// Output data from each row
		echo "<tr>";
		echo "<td>" . $row['forname'] . "</td>";
		echo "<td>" . $row['lastname'] . "</td>";
		echo "<td>" . $row['role'] . "</td>";
		echo "<td>" . $row['ext'] . "</td>";
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
$mysqli->close();
}
?>
</div>
</body>
</html>
