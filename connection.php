<?php
$id = 'DK' . rand(6000,6999);
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mob'];
$passwd=$_POST['pass'];
$regtype=$_POST['regtype'];
$ticket=$_POST['ticket'];


if(!empty($name) || !empty($email) || !empty($mobile) || !empty($passwd) || !empty($regtype) || !empty($ticket))
{
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="dk";
	//create connection 
	$conn = new mysqli($servername, $username, $password, $dbname);
	if(mysqli_connect_error())
	{
		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	}
	else
	{
		$hashed = hash('sha512', $passwd);
		
		$imgname = $_FILES['image']['name'];
		$imgtmploc = $_FILES['image']['tmp_name'];
		
		$imgdata = base64_encode(file_get_contents($imgtmploc));
		
		
		
		
		$SELECT = "SELECT email from register where email=? LIMIT 1";
		$INSERT = "INSERT INTO register(id, name, email, mobile, passwd, imgname, img, regtype, ticket) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		//prepare statement
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum==0)
		{
			$stmt->close();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssissssi", $id, $name, $email, $mobile, $hashed, $imgname, $imgdata, $regtype, $ticket);
			$stmt->execute();

			readfile("success.html");
			echo "<script>alert('Registration ID: ' + '$id')</script>";
		}
		else
		{
			echo "Someone already registered using this email";
		}
		$stmt->close();
		$conn->close();
	}
}
else
{
	echo "All Fields are Required";
	die();
}

?>