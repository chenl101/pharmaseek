<!DOCTYPE html>
<html>
<head>
  <title>PharmaSeek</title>
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
  padding: 5px;
  text-align: left;
}

</style>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="MainPage.html">PharmaSeek</a>
    <a style = "text-align:right" class="navbar-brand" href="Admin_Log_In.php">Admin Login</a>
  </nav>
<div class="container">
  <h1 style="text-align:center;">PharmaSeek</h1>
  <h4 style = "text-align:center;color: gray">Search For Medicine of Interest</h4>
  <div style = "margin-top: 50px"class="row">
    <div class="col-lg-4" style="background-color:lavender">
    	<h4 style = "margin-top: 50px">Some Useful Information</h4><br>
    	
      <a href="./rankings.php?action=top_factory">The factories producing the most medicine </a><br><br>
      <a href="./rankings.php?action=top_brand">The brands selling the most medicine</a><br><br>
      <a href="./rankings.php?action=most_branch_retailer">The retailers with the most branches</a><br><br>
      <a href="./rankings.php?action=most_medicine_retailer">The retailers selling the most medicine</a><br><br>
      <a href="./rankings.php?action=cheapest_medicine">The cheapest medicine</a><br><br>
      <a href="./rankings.php?action=top_headache_medicine">The most effective medicine for headache</a><br><br>
      <a href="./rankings.php?action=top_antibiotics">The most effecive antibiotics</a><br><br></div>
    	
    	
    <div class="col-lg-8" style = "margin:auto;">
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

            $sql = "";
            $value = "";
            $header = "";
            switch($_GET[action]){
              case 'top_factory': $value = "Medicine Count"; $header = "The Factories Producing the Most Medicine"; $sql = "SELECT brand.name, COUNT(medicine.medicine_id) AS amount FROM brand JOIN medicine ON brand.brand_id = medicine.brand_id GROUP BY brand.name ORDER BY amount DESC LIMIT 20";
              break;
              case 'top_brand': $value = "Medicine Count"; $header = "The Brands Selling the Most Medicine"; $sql = "SELECT factory.name, COUNT(medicine.medicine_id) AS amount FROM factory JOIN brand ON brand.factory_id = factory.factory_id JOIN medicine ON brand.brand_id = medicine.brand_id GROUP BY factory.name ORDER BY amount DESC LIMIT 20";
              break;
              case 'most_branch_retailer': $value = "Branch Count";$header = "The Retailers with The Most Branches"; $sql = "SELECT retailer.name,retailer.branch_count as amount FROM retailer ORDER BY branch_count DESC limit 20";
              break;
              case 'most_medicine_retailer': $value = "Medicine Count"; $header = "The Retailers Selling the Most Medicine"; $sql = "SELECT retailer.name, COUNT(medicine_retailer.retailer_id) as amount FROM retailer JOIN medicine_retailer ON retailer.retailer_id = medicine_retailer.retailer_id GROUP BY retailer.retailer_id ORDER BY COUNT(medicine_retailer.retailer_id) DESC LIMIT 20;";
              break;
              case 'cheapest_medicine': $value = "Average Price"; $header = "The Cheapest Medicine"; $sql = "SELECT medicine.name, CAST(AVG(medicine_retailer.price) AS DECIMAL(10,2)) as amount FROM medicine JOIN medicine_retailer ON medicine.medicine_id = medicine_retailer.medicine_id GROUP BY medicine.name ORDER BY AVG(medicine_retailer.price) limit 20";
              break;
              case 'top_headache_medicine': $value = "Average Price"; $header = "The Most Effective Medicine for Headache"; $sql = "SELECT medicine.name, medicine_illness.effectiveness as amount FROM medicine JOIN medicine_illness ON medicine.medicine_id = medicine_illness.medicine_id JOIN illness ON medicine_illness.illness_id = illness.illness_id WHERE illness.major_symptoms LIKE '%headache%' ORDER BY medicine_illness.effectiveness DESC limit 20";
              break;
              case 'top_antibiotics': $value = "Average Price"; $header = "The Most Effective Antibiotics"; $sql = "SELECT medicine.name, medicine_illness.effectiveness as amount FROM medicine JOIN medicine_illness ON medicine.medicine_id = medicine_illness.medicine_id JOIN drug_type ON drug_type.type_id = medicine.type_id WHERE drug_type.name = 'Antibiotics' ORDER BY medicine_illness.effectiveness DESC limit 20";
              break;
            }

            echo "<h4 style = 'text-align: center'>".$header."</h4><br>";
            $result = $conn->query($sql);
            $index = 1;
            if ($result){
              echo "<table style='width:100%'><tr><th>Ranking</th><th>Name</th><th>".$value."</th></tr>";
              while($row = $result->fetch_assoc()){
                echo "<tr><td>".$index. "</td><td>".$row["name"]. "</td><td>".$row["amount"]. "</td></tr>";
                $index = $index + 1;
              }

              echo "</table>";
              
            }
            //$result->free();
      // Close connection
           mysqli_close($conn);

            ?>

    </div>
</div>

</body>


  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</html>