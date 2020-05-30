<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	$email = $_SESSION['email'];
	$conn = mysqli_connect("localhost", "root", "", "dk");
	if(mysqli_connect_errno())
	{  
		die("Failed to connect with MySQL: ". mysqli_connect_error());  
	} 
	$result = mysqli_query($conn, "select name,email,mobile,img,regtype from register where email='$email'");
	$retrive = mysqli_fetch_array($result);
	$name = $retrive['name'];
	$mobile = $retrive['mobile'];
	$regtype = $retrive['regtype'];
	
?>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/home1.png"/>
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
  
</head>

<body style="background-color: #1abc9c; ">
	
	
	<div class="container">
	  <div class="row">
	    
		<div class="col-12 col-sm-8 col-md-6 col-lg-4">
		<h4 class="text-danger"><center>PROFILE</center></h4><br>
		  <div class="card">
			<img class="card-img-top" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/oslo.jpg" alt="Bologna">
			<div class="card-body text-center">
			  <?php echo '<img class="avatar rounded-circle" src="data:image;base64,'.$retrive['img'].' " alt="$name"> ';	?>
			  <h4 class="card-title"> <?php echo ($name);	?> </h4>
			  <h6 class="card-subtitle mb-2 text-muted"> <?php echo ($regtype); ?> </h6>
			  <p class="card-text"> <?php echo ($email); ?> </p><br>
			  <p class="card-text">Contact : <?php echo ($mobile); ?> </p><br>
			  
			  <a href="https://twitter.com/login" class="btn btn-outline-info">Twitter</a>
			  <a href="https://www.facebook.com/" class="btn btn-outline-info">Facebook</a>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	
	

	
</body>
</html>
