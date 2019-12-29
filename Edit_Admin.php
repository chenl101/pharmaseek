<?php
	// Create connection
	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$database = "pharmaSeek";
	$conn = new mysqli($servername, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
 
	$id = $_POST["id"];
	$name = $_POST["name"];
	$type = $_POST["type"];
	$date = $_POST["date"];
	$chem = $_POST["chem"];
	$pres = $_POST["pres"];
	$market = $_POST["market"];
	// Generate sql
	$sql = "UPDATE medicine
	SET name = '$name', type_id = '$type', reg_date = '$date', chemical_id = '$chem', prescription = '$pres', in_market = '$market'
	Where medicine_id = '$ID';
	";


	if ($conn->query($sql) === TRUE) {
	    echo "Successful! ".'<a href="MainPage_Admin.php">Check the result!</a>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    //echo "Something Wrong! ".'<p><<a href="MainPage_Admin.php">Try again!</a></p>';
	}

	// Close connection
	mysqli_close($conn);
?>