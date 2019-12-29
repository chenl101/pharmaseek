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

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "mysql";
  $database = "PharmaSeek";
  $conn = new mysqli($servername, $username, $password, $database);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


  $ID = $_GET["id"];

  $sql = "SELECT * FROM medicine where medicine_id = '$ID'";
  
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $id = $row['medicine_id'];
  $name = $row['name'];
  $brand= $row["brand_id"];
  $type = $row["type_id"];
  $date = $row["reg_date"];
  $chem = $row["chemical_id"];
  $pres = $row["prescription"];
  $market = $row["in_market"];

  ?>  

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
          <div style = "margin-top: 50px" class="row">
          <div class="col-lg-4" style = "margin-top:50px, margin-left:300px"></div>
          <div class="col-lg-8">
          <form name = "udpate" action = "Edit_Admin.php" method = "POST">
          <p>ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $id; ?><input type = "hidden" name = "id" value = "<?php echo $id; ?>"> </p>
          <p>Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?><input type = "hidden" name = "name" value = "<?php echo $name; ?>"> </p></p>
          <p>Brand: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $brand; ?><input type = "hidden" name = "brand" value = "<?php echo $brand; ?>"> </p></p>
          <p>Drug Type: <input style = "margin-left: 50px" type="text" placeholder = 'e.g. 1-11' name="type"></p>
          <p>Registered Date: <input style = "margin-left: 10px"  type="text" placeholder = 'e.g. 20010101' name="date"></p>
          <p>Chemical: <input style = "margin-left: 60px" type="text" placeholder = 'e.g. 1-2426' name="chem"></p>
          <p>Prescription: <input style = "margin-left: 40px" type="text" placeholder = "1: required; 0: not"name="pres"></p>
          <p>In Market: <input style = "margin-left: 60px"type="text" placeholder = "1: in market; 0: not" name="market"></p>
          <input type="submit" name="MedEdit" value="Update Medicine"> </p></div></form>
        </div>
        </div>
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