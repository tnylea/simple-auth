<?php
session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM  users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';
	$user = NULL;

	if( count($results) > 0 ){
		$user = $results;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to your Web App</title>
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="header">
		<a href="/">Your App Name</a>
	</div>

	<?php if( !$user ): ?>

		<?= $_SESSION['user_id']; ?>
		<h1>Please Login or Register</h1>
		<a href="login.php">Login</a> or
		<a href="register.php">Regiser</a>

	<?php else: ?>

		<br />
		Welcome <?= $user['email']; ?>
		<br /><br />You are successfully logged in!
		<br /><br /><a href="logout.php">Logout?</a>

	<?php endif; ?>

</body>
</html>