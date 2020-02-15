<?php
$name = $regid = $email = $password = $comment = $subject = $gender = "";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name = $_POST["name"];
		$regid = $_POST["regid"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$comment = $_POST["comment"];
		$subject = $_POST["subject"];
		$gender = $_POST["gender"];
	
	
		$servername = "localhost";
		$username = "root";
		$dbpass = "";
		$dbname = "xyzclg";
	
		$conn = new mysqli($servername, $username, $dbpass, $dbname);
	
		if($conn->connect_error)
		{
			die("Connection failed:" .$conn->connect_error);
		}
		else
		{
			echo("Connected to Database");
		}
		$sql = "INSERT INTO student_details(name,regid,email,password,comment,subject,gender) VALUES 
		('".$name."','".$regid."','".$email."','".$password."','".$comment."','".$subject."','".$gender."')";
		if($conn->query($sql) == TRUE)
		{
			header("Location: index.php");

		}
		else
		{
			echo "Error:" .$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
?>
