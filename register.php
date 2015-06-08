<?php

session_start();

if( isset($_SESSION['user_id']) ){
    header("location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])){

	$sql = "INSERT INTO users (email,password) VALUES (:email,:password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
		$message = 'Successfully Created New User';
	else:
		$message = 'Error creating new user';
	endif;

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="header">
		<a href="/">Your App Name</a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message; ?></p>
	<?php endif; ?>

	<h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>

	<form action="register.php" method="POST">

		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="Your desired password" name="password">
		<input type="password" placeholder="Confirm your password" name="password_confirm">
		<input type="submit">
		
	</form>

</body>
</html>