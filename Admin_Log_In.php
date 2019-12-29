<html>
<head>
<!-- Bootstrap4 CSS -->
<link rel="stylesheet"
  href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">

<title>PharmaSeek</title>
</head>
<body>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="MainPage.html">PharmaSeek</a>
  </nav>
  <div>
    <div>
      <h1 style="text-align:center;">PharmaSeek</h1>
      <h4 style = "text-align:center;color: gray">Administrator Login</h4>
      
    </div>
    <div>
      
    </div>
  </div>

  <div>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
      <div class="form-group">
        <label for="exampleInputEmail1">User ID</label> 
        <input type="text" class="form-control" id="userName" placeholder="Enter User ID" name="idUser" required autofocus/> 
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label> 
        <input type="password" class="form-control" id="userPsw" placeholder="Password" name="password" required/>
      </div>    
      <div>
        <button type="submit" value="login" class="btn btn-primary">Login</button>
      </div>      
    </form>
  </div>

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
      if( isset($_POST['idUser']) and isset($_POST['password']) ) {
          
          $user=$_POST['idUser'];
          $pass=$_POST['password'];
       
          $ret=mysqli_query( $conn, "SELECT * FROM admin_info WHERE user_id='$user' AND password='$pass' ") or die("Could not execute query: " .mysqli_error($conn));
          $row = mysqli_fetch_assoc($ret);
          if(!$row) {
            header("Location: Admin_Log_In.php");
          }
          else {
                session_start();
                $_SESSION['user']=$user;
            header('location: MainPage_Admin.php');
          }
}

  ?>

</body>

<style type="text/css">
.title {
  text-align: center;
}
.message {
  text-align: center;
  font-size: 18px;
  margin: 10px;
}
.form{
  width: 400px;
  margin: 40px auto;
}
.btn{
  float: right;
}
.link{
  margin: auto 0px;
}
</style>

<!-- jQuery -->
<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
<!-- popper.min.js -->
<script
  src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
<!-- Bootstrap4 JavaScript -->
<script
  src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

</html>