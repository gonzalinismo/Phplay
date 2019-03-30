<?php
	session_start();
	require 'dbconfig/config.php';
	require 'play.php';
	$_SESSION['visibility']="hide";
	$_SESSION['listid']= $_GET['listid'];
	
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
			 <h2>lista <?php echo $_SESSION['listid'] ?>!</h2>
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
		<div>
			<h2> List id <?php echo $_GET['listid']?></h2>
		</div>
		<div class="row" name="optiondiv" >	
			 <form <?php echo "action=openList.php?listid=" ; echo $_SESSION['listid']; ?> method="post" >
			 	<input type="submit" name="addbtn" class="btn col l2 s2 m2" value="add list item">			 	
			 	<a href="home.php" ><input class="btn col s2 m2 l2" type="button" id="regbtn" value="back"></a>
			 </form><br>	 		
		 	<?php 		 	
			 	if (isset($_POST['addbtn'])) {
			 		$_SESSION['visibility']=" ";		 			
			 	}		 	
		  	?>
		  	<br>
			 <div name="añadir" id="newListForm">
			 	<form method="post" <?php echo "action=openList.php?listid=" ; echo $_SESSION['listid']; ?> class="<?php echo $_SESSION['visibility']; ?>">
			 		<label >Video's name</label>
			 		<input type="text" name="videoName" placeholder="type in videos's name">		 		
			 		<label >Video's artist</label>
			 		<input type="text" name="videoArtist" placeholder="type in video's artist">
			 		<label >Video's url</label>
			 		<input type="text" name="videoLink" placeholder="type in videos's link">		 				 		
			 		<input type="submit" name="sendbtn" class="btn col s2 l2 m2" value="Add new item">
			 		<input type="submit" name="hide" class="btn col s2 l2 m2" value="hide">		 		
			 	</form>	
			 </div>
			 <?php 

			 	if (isset($_POST['hide']) ) {
			 		$_SESSION['visibility']="hide";		 				 			
			 	}
			 	if (isset($_POST['sendbtn']) ) {
			 		$userid=$_SESSION['username'];
			 		$listid=$_SESSION['listid'];
			 		$videoname=$_POST['videoName'];
			 		$videoartist=$_POST['videoArtist'];
			 		$videolink=$_POST['videoLink'];
			 		$query="insert into video (name, artist, link, belongingList) values ('$videoname', '$videoartist', '$videolink', '$listid')";
			 		$query_run= mysqli_query($con, $query);
			 		header('openList.php?listid='.$_SESSION['listid']);
			 		exit();		 		
				}		 				 					 	
			 
	          		$listid=$_SESSION['listid'];
		          	$query1="select * from video WHERE belongingList='$listid' ";
		          	$query_run1= mysqli_query($con, $query1);	          	
		          	if ($query_run1) {
		          		if (mysqli_num_rows($query_run1)==0) {
		          			echo "<h2>No items added yet </h2>";
		          		}
		          		if (mysqli_num_rows($query_run1)>0) {
		          			echo "<table>
				        				<thead>
				          					<tr>
				              					<th>Tittle</th>             
				              					<th>Artist</th>
				              					<th>Link</th>
				              					<th>Options</th>
				          					</tr>
				          				</thead>
				          				<tbody>";
				          	while ( $row = mysqli_fetch_assoc($query_run1)) {
				          		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $row['link'], $matches);
		    					$id = $matches[1];
				          		echo "<tr>";
				          		echo "<td>". $row['name'] ."</td>";
				          		echo "<td>". $row['artist'] ."</td>";
				          		echo "<td>". $id ."</td>";
				          		echo '<td> <form action="openList.php?listid='.$listid.'&enlace='.$id.'" method="post">
				          						<input type="submit" value="play" class="btn"></form>
				          						</input> <a><i class=" btn material-icons small">remove_circle</i> </a> </td>';
				          	}			
		          		}
		          	}
	          ?>

	        </thead>
	     </table>
		 </div>
		 <div name="player ">
		 <?php
		    $url = 'https://www.youtube.com/watch?v=dWZNtpNRpG8';
		    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
		    $id = $matches[1];
		    $width = '800px';
		    $height = '450px';
		?>
		<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
		    src="https://www.youtube.com/embed/<?php echo $_GET['enlace'] ?>"?rel=0&showinfo=0&color=white&iv_load_policy=3"
		    frameborder="0" allowfullscreen></iframe> 
    	</div>
	

	<!--body div closing-->		 
	</div>	
</body>
</html>	