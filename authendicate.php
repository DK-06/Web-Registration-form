<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dk");
if(mysqli_connect_errno())
{  
	die("Failed to connect with MySQL: ". mysqli_connect_error());  
} 
$email=$_POST['email'];
$passwd=$_POST['pass'];
	
	//avoid sql injection
	$email = stripcslashes($email);  
	$passwd = stripcslashes($passwd);  
	$email = mysqli_real_escape_string($conn, $email);  
	$passwd = mysqli_real_escape_string($conn, $passwd);

	$hashed = hash('sha512', $passwd);
	$splithashed=substr($hashed,0,40);
	
	$query = "SELECT * FROM register WHERE email='$email' && passwd='$splithashed'";
	$result = mysqli_query($conn, $query) or die("Failed to query error" .mysqli_error());
	if(mysqli_num_rows($result)>0)
	{
		
		$query = "SELECT * FROM register";
		$result = mysqli_query($conn, $query) or die("Failed to query error" .mysqli_error());
		while ($row = mysqli_fetch_array($result))
		{
			$_SESSION['email']=$email;
			header('location:home.html');
		}		
	}
	else
	{
		echo "email or Password is Invalid";
	}
mysqli_close($conn); // Closing connection
?>