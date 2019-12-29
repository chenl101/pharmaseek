<!DOCTYPE html>

<html>
	<head>
		<title> PharmaSeek </title>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
		
	</head>
	<body>
		
	<style>
	* {
	  box-sizing: border-box;
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
		
		<form name= "search" action = "searchByMed.php" method = "POST">
			<h1 style = "text-align:center;"> Result Found</h1>
			<h4 style = "text-align:center; color: gray">Search By Retailer </h4><br>
		</form>
		<div class="col-lg-2" style = "margin:auto;"></div>
		<div class="col-lg-10" style = "margin:auto;">
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
			
			$name = $_POST["retailer_name"];
	
			$sql = "select medicine.medicine_id,medicine.name as medicine, brand.name as brand from medicine join brand on medicine.medicine_id = brand.brand_id join medicine_retailer on medicine.medicine_id = medicine_retailer.medicine_id join retailer on medicine_retailer.retailer_id = retailer.retailer_id where retailer.name like '%$name%'";
							
			$result = $conn->query($sql);
			echo "<p style = 'color: gray; font-size:20px;'> Query Input ".$name."</p>";
			if ($result)
			{
				echo "<table style='width:100%;'>
							<tr><th>ID</th>
							<th>Name</th>
							<th>Brand</th>
							<th>Details</th>
							<th>Retailers</th>
							<th>Illness</th></tr>";
							
				while($row = $result -> fetch_assoc())
				{
					echo "<tr><td>".$row["medicine_id"]. "</td>
									<td align='center' >".$row["medicine"]. "</td>
									<td align='center' >".$row["brand"]. "</td>
									<td align='center'>"."<a href=./medDetails.php?id=".$row['medicine_id'].">View</a>"."</td>
									<td align='center'>"."<a href=./medRetailers.php?id=".$row['medicine_id'].">View</a>"."</td>
									<td align='center'>"."<a href=./medIllness.php?id=".$row['medicine_id'].">View</a>"."</td></tr>";
				}
				
				$result->free();
				mysqli_close($conn);
			}
			
			else
					{
						echo("Error description: " . mysqli_error($conn));
					}	
		?>
	</div>

</body>
</html>