<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="style.css">	
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<title></title>
</head>
<body>
	  <nav>
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo">PHPlay</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="badges.html">Components</a></li>
	        <li><a href="collapsible.html">JavaScript</a></li>
	      </ul>
	    </div>
	  </nav>

	  <div id="main-wrapper" class="container ">
	  	 <h2>Login</h2>
		 <form action="index.php" method="post" class="l8 m8 s8">
		 	<label>User</label>
		 	<input type="text" name="username"><br>
		 	<label>Password</label>
		 	<input type="password" name="password"><br>
		 	<div class="row">
			 	<input type="submit" name="loginbtn" class="btn col s3 l3 m3" value="log in">
			 	<a class="col s1 l1 m1"> 
			 	<a href="register.php" ><input type="button" class="btn col s3 l3 m3" id="regbtn" value="register"></a><br>		 
		 	</div>
		 	<?php
		 	if (isset($_POST['loginbtn'])) {		 
		 	
		 	$username= $_POST['username'];	
		 	$password= $_POST['password'];
		 	$query="select * from user WHERE name='$username'AND password= '$password' " ;
			$query_run= mysqli_query($con, $query);
			if (!empty($query_run) && mysqli_num_rows($query_run)>0) {
				$_SESSION['username']= $username;
				header('location:home.php');
			}else{
				echo "check username";
			}
			}
		 	?>
	  </div>


</body>
</html>