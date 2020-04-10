<?php
	$servername = "localhost";
    $username = "test1";
    $password = "test1";
	$db = "UserData";

	$user = $_POST['username'];
	$email = $_POST['email'];
	$pass = md5($_POST['password']);
	$url = "";
	
	$conn = mysqli_connect($servername, $username, $password, $db);

	$sql = "INSERT INTO User (user, email, password, url)
	VALUES ('$user', '$email', '$pass', '$url')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
		header('Location: ../login.html');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		header('Location: ../register.html?error=1');
	}
?>