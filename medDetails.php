<!DOCTYPE html>

<html>
	<head>
		<title> PharmaSeek  </title>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
		
	</head>
	<body>
		
	<style>
	* {
	  box-sizing: border-box;
	}
	aside {
	  float: left;
	  margin: 0 1.5%;
	  width: 30%;}
	
	section {
	  float: right;
	  margin: 0 1.5%;
	  width: 65%;
	}
	
	th, td {
  padding: 10px;
  text-align: left;
}
	</style>

	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="MainPage.html">PharmaSeek</a>
    <a style = "text-align:right" class="navbar-brand" href="Admin_Log_In.php">Admin Login</a>
  </nav>
		
		<form name= "search" action = "medDetails.php" method = "POST">
			<h1 style = "text-align:center;"> Medicine Details</h1>
		</form>
		<div class="col-lg-1" style = "margin:auto;"></div>
		<div class="col-lg-11" style = "margin:auto;">
		<?php
		// Create connection
			$servername = "localhost";
			$username = "root";
			$password = "mysql";
			$database = "pharmaSeek";
			$conn = new mysqli($servername, $username, $password, $database);
			// Check connection
			if ($conn->connect_error) 
			{
			    die("Connection failed: " . $conn->connect_error);
			} 

			$id = $_GET['id'];
	
			$sql = "SELECT m.medicine_id, m.name, t.name as drugType, b.name as brand, 
								c.name as chem, m.reg_date, m.prescription, m.in_market 
								FROM medicine m JOIN drug_type t ON m.type_id = t.type_id
								JOIN brand b ON m.brand_id = b.brand_id
								JOIN chemical c ON m.chemical_id = c.chemical_id						
								WHERE medicine_id = '$id';";
			
			//$result = $conn->query($sql);
			$result = $conn->query($sql);
			echo "<p style = 'color: gray; font-size:20px;'> Medicine ID ".$id."</p>";
			if ($result->num_rows > 0) 
			{
				echo "<table style='width:100%;'>
							<tr><th>ID</th>
							<th>Name</th>
							<th>Drug Type</th>
							<th>Brand</th>
							<th>Chemical</th>
							<th>Registered Date</th>
							<th>Prescription</th>
							<th>In Markter</th></tr>";
							
				while($row = $result -> fetch_assoc())
				{
					echo "<tr><td>".$row["medicine_id"]. "</td>
									<td>".$row["name"]. "</td>
									<td>".$row["drugType"]. "</td>
									<td>".$row["brand"]. "</td>
									<td>".$row["chem"]. "</td>
									<td>".$row["reg_date"]. "</td>
									<td>".$row["prescription"]. "</td>
									<td>".$row["in_market"]. "</td>
									</tr>";
				}
				
				$result->free();
				mysqli_close($conn);
			}
			else
					{
						echo("No information found. Please check you input query. ");
					}	
		?>

</body>
</html>