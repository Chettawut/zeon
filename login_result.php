<?php

session_start();
include('backend/conn.php');

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT firstname,lastname,id,password,type,status FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();


}


if ($stmt->num_rows > 0) {
	$stmt->bind_result($firstname,$lastname,$code,$password,$type,$status);
	$stmt->fetch();
 
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {

		if($status=='Y')
		{
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['type'] = $type;			

			
			// echo 'Welcome ' . $_SESSION['name'] . '!';
			header( "Location: backend");
		}
		else{
			header( "Location: ..?log=disable");
		}
	} else {
		echo 'Incorrect password!';
		header( "Location: ..?log=password");
	}
} else {
	echo 'Incorrect username!';
	header( "Location: ..?log=username");
}



?>