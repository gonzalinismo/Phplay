<?php
	session_start();
	require 'dbconfig/config.php';
	$_SESSION['visibility']="hide";
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
		 <div id="sessiondiv">
			 <h2>Welcome back, <?php echo $_SESSION['username'] ?>!</h2>
			 <form action="home.php" method="post">
			 <input type="submit" name="logout" class="btn col s3 l3 m3" value="log out">
			 </form>
			 <?php
			 	if (isset($_POST['logout'])) {		 		
			 		session_destroy();
			 		header('location:index.php');
			 	}
			 ?>
		 </div>
		 <br>
		 <div class="row" name="optiondiv" >	
			 <form action="home.php" method="post">
			 	<input type="submit" name="addbtn" class="btn col l2 s2 m2" value="add list">			 	
			 	
			 </form><br>	 		
		 	<?php 		 	
			 	if (isset($_POST['addbtn'])) {
			 		$_SESSION['visibility']=" ";		 			
			 	}		 	
		  	?>
		  	<br>
			 <div name="añadir" id="newListForm">
			 	<form method="post" action="home.php" class="<?php echo $_SESSION['visibility']; ?>">
			 		<label >List name</label>
			 		<input type="text" name="listName" placeholder="type in list's name">		 		
			 		<input type="submit" name="sendbtn" class="btn col s2 l2 m2" value="Add new list">
			 		<input type="submit" name="hide" class="btn col s2 l2 m2" value="hide">		 		
			 	</form>	
			 </div>
			 <?php 

			 	if (isset($_POST['hide']) ) {
			 		$_SESSION['visibility']="hide";		 				 			
			 	}
			 	if (isset($_POST['sendbtn']) ) {
			 		$userid=$_SESSION['username'];
			 		$listid=$_POST['listName'];
			 		$query="insert into userlist (userid,listname) values ('$userid', '$listid')";
			 		$query_run= mysqli_query($con, $query);
			 		header('home.php');
			 		exit();		 		
				}		 				 					 	
			 ?>
		 </div> 
		 
		 
	          <?php
	          		$userid=$_SESSION['username'];
		          	$query="select * from userlist WHERE userid ='$userid'";
		          	$query_run= mysqli_query($con, $query);	          	
		          	if ($query_run) {
		          		if (mysqli_num_rows($query_run)==0) {
		          			echo "<h2>No lists added yet </h2>";
		          		}
		          		if (mysqli_num_rows($query_run)>0) {
		          			echo '<table display="block">
				        				<thead>
				          					<tr>
				              					<th>List Name</th>	              
				              					<th>Options</th>
				          					</tr>
				          				</thead>
				          				<tbody>';
				          	while ( $row = mysqli_fetch_assoc($query_run)) {
				          		echo "<tr>";
				          		echo "<td>". $row['listname'] ."</td>";
				          		echo '<td> <a href="openList.php?listid='.$row['listId'].'"><i class="btn material-icons small">remove_red_eye</i> </a> <a><i class=" btn material-icons small">remove_circle</i> </a> </td>';
				          	}			
		          		}
		          	}
	          ?>

	        </thead>
	     </table>
	</div>

</body>
</html> 