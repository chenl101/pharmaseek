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
  width: 30%;
}
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

<nav class="navbar navbar-light" style="background-color: coral;">
    <a class="navbar-brand" href="MainPage_Admin.php">PharmaSeek</a>
    <a style = "text-align:right" class="navbar-brand" href="MainPage.html">Logout</a>
  </nav>
<div class="container">
  <h1 style="text-align:center;">PharmaSeek</h1>
  <h4 style = "text-align:center; color: gray">Administration Page</h4>
  

    
      <div style = "margin-top: 50px" class="row">

        <div class="col-lg-4" style="background-color:lavender; margin: auto,5px">
          <form name="insert" action="MainPage_Admin.php" method="POST">
        	<h4>Add New Records</h4><br>
          <p>Insert New Medicine: </p>
          <p>Name: <input style = "margin-left: 80px" type="text" name="name" placeholder = 'e.g. Advil Pain Relief' required="required"></p>
          <p>Brand: <input style = "margin-left: 80px" type="text" name="brand_1" placeholder = 'e.g. 1-1802' required="required"></p>
          <p>Drug Type: <input style = "margin-left: 50px" type="text" placeholder = 'e.g. 1-11' name="type_1"></p>
          <p>Registered Date: <input style = "margin-left: 10px"  type="text" placeholder = 'e.g. 20010101' name="date_1"></p>
          <p>Chemical: <input style = "margin-left: 60px" type="text" placeholder = 'e.g. 1-2426' name="chem_1"></p>
          <p>Prescription: <input style = "margin-left: 40px" type="text" placeholder = "1: required; 0: not"name="pres_1"></p>
          <p>In Market: <input style = "margin-left: 60px"type="text" placeholder = "1: in market; 0: not" name="market_1"></p>
          <input type="submit" name="MedInsert" value="Insert New Medicine"> </p></div>
        </form>
        
        <div class="col-lg-8" style = "margin-top:50px, margin-left:300px">
          <form name = "search" action = "MainPage_Admin.php" method = "POST">
        	<h4 style = 'text-align:center'>Check Current Records</h4><br>
          <p style = 'text-align:center'>Medicine Name: <input style = "margin-left: 30px;margin-right:30px" type="text" name="medicine" placeholder = 'e.g. Advil Pain Relief'>
          <input type="submit" name="MedUpdate" value="Search Current Medicine"> </p></form>

          <?php

    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $database = "PharmaSeek";
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    //parse parameters
      $medicine = $_POST["medicine"];

      $name = addslashes($_POST["name"]);
      $brand_1= (int)$_POST["brand_1"];
      $type_1 = (int)$_POST["type_1"];
      $date_1 = $_POST["date_1"];
      $chem_1 = (int)$_POST["chem_1"];
      $pres_1 = $_POST["pres_1"];
      $market_1 = $_POST["market_1"];

      if (isset($_POST['MedInsert'])){
      if (empty(name_1) || empty(brand_1))
        {
          die("Please provide input in name and brand fields.");
        }

      // Generate sql
      $sql = "INSERT INTO medicine (name, type_id, brand_id, chemical_id, reg_date, prescription, in_market)
      VALUES ('$name','$type_1','$brand_1','$chem_1','$date_1','$pres_1','$market_1');";
      if ($conn->query($sql) === TRUE) {
            echo "<p style = 'text-align: center'>Insert Successfully</p>";
        } else
          {
            echo("Insertion Failed. Please check your query input.");
          }
        }

  if (isset($_POST['MedUpdate'])){
      $sql = "SELECT medicine.medicine_id,medicine.name as medicine ,brand.name as brand from medicine join brand on medicine.brand_id = brand.brand_id where medicine.name like '%$medicine%';";
      
      //$result = $conn->query($sql);
    $result = $conn->query($sql);
      echo "<p style = 'color: gray; font-size:20px;'> Query Input ".$medicine."</p>";
      if ($result->num_rows > 0) 
      {
        echo "<table style='width:100%;'>
              <tr><th>ID</th>
              <th>Name</th>
              <th>Brand</th>
              <th>Update</th>
              <th>Delete</th></tr>";
              
        while($row = $result -> fetch_assoc())
        {
          echo "<tr><td>".$row["medicine_id"]. "</td>
                  <td>".$row["medicine"]. "</td>
                  <td>".$row["brand"]. "</td>
                  <td>"."<a href=./Update_Admin.php?id=".$row['medicine_id'].">Update</a>"."</td>
                  <td>"."<a href=./Delete_Admin.php?id=".$row['medicine_id'].">Delete</a>"."</td></tr>";

        }
        
        $result->free();
        mysqli_close($conn);
      }
      
    else
          {
            echo("No information found. Please check your query input. ");
          } 

         } 

    ?>
        </div>
      </div>

			</div>
    </form>

    </div>
  </div>
</div>



</body>


  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</html>