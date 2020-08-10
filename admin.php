<?php


session_start(); // Starting Session

$errors = array();

if (isset($_POST['submit'])) {
if (empty($_POST['admin']) || empty($_POST['password'])) {
array_push($errors, "UserID or password is required");
}
else
{
// Define $userID and $password
$userID = $_POST['admin'];
$password = $_POST['password'];

// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "project");

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT admin, password from adminlogin where admin=? AND password=? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $userID, $password);
$stmt->execute();
$stmt->bind_result($userID, $password);
$stmt->store_result();

if($stmt->fetch()) //fetching the contents of the row
        {
          $_SESSION['login_user'] = $username; // Initializing Session
          header("location: home.php"); // Redirecting To Profile Page
        }
else {
      array_push($errors, "UserID or password is invalid");
     }

mysqli_close($conn); // Closing Connection
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Walmart</title>
	
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
	<div class="main">
		<div class="logo"><img src="logo.png"></div>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li  class="active"><a href="#">Admin</a></li>
			<li><a href="Product.php">Employee</a></li>
			
		</ul>
	</div>
	<div class="Logintitle">
		<h2>Login Page</h2>

		</div>

		 <form action="" method="post">

     <?php include ('errors.php') ?>


  <div class="login-box">
  
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" name="admin" placeholder="Enter Your ID">
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input  type="password" name="password" placeholder="Enter Password">
  </div>
   </div>
    <div class="button">
   		
      <button class="btn" type="submit"  name="submit">Login</button>
   	</div>
   
   
   <form>
		
		

		
		<div class="footer">
        &copy;1993 - 2020 Walmart Bangladesh. All rights reserved.
    </div>
</header>
</body>
</html>