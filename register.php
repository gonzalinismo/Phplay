<?php
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
	<div id="main-wrapper" class="container">
		 <h2>Sign up</h2>
		 <form action="register.php" method="post">
		 	<label>User</label>
		 	<input type="text" name="username"><br>
		 	<label>Password</label>
		 	<input type="password" name="password"><br>
		 	<label>confirm Password</label>
		 	<input type="password" name="passwordConfirm"><br>
		 	<div class="row">
		 	<input type="submit" class="btn col s3 l3 m3" id="signupbtn" name="submitbtn" value="sign up"> 
		 	<a href="" class=" col s1 m1 l1"> </a>
		 	<a href="index.php" ><input class="btn col s3 m3 l3" type="button" id="regbtn" value="back"></a><br>
		 	</div>
		 	<?php
		 		if (isset($_POST['submitbtn'])) {
		 			//echo'<script type="text/javascript">alert("boton")</script>';
		 			$username= $_POST['username'];	
		 			$password= $_POST['password'];
		 			$passwordConfirm= $_POST['passwordConfirm'];
		 			if ($password==$passwordConfirm && $password!='') {
		 				$query="select * from user WHERE name='$username'";
		 				$query_run= mysqli_query($con, $query);
		 				if (mysqli_num_rows($query_run)>0) {
		 					echo "user exists";
		 				}else{
		 					$query1= "insert into user (name, password) values('$username','$password')";
		 					$query_run=mysqli_query($con, $query1);
		 							 					
		 					if ($query_run) {
		 						echo'<script type="text/javascript">alert("go to login")</script>';
		 					}else{
		 						echo'<script type="text/javascript">alert("error")</script>';
		 					}
		 				}

		 			}else{
		 				echo '<script type="text/javascript">alert("error")</script>';
		 			}
		 		}
		 	?>
		 </form>	


	</div>

</body> 
</html> 