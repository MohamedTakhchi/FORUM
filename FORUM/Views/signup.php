<?php
	require_once('../Class/User.class.php');
	if (isset($_POST['aj'])) {
		$user = new User();
		$user->setName($_POST['nom']);
		$user->setEmail($_POST['email']);
		$user->setUsername($_POST['username']);
		$user->setAvatar($_POST['avatar']);
		if ($user->SignUp($_POST['password'])==0) {
			echo "good";
		}
		else {
			echo "not good";
		}
	}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="W3style.css">
  		<title>Challenge</title>
	</head>
	<body>
			<form method="post" action="">
				<input type="text" name="nom" placeholder="nom">
				<input type="text" name="email" placeholder="email">				
				<input type="text" name="username" placeholder="username">
				<input type="text" name="password" placeholder="password">
				<input type="text" name="avatar" placeholder="avatar">
				<input type="submit" name="aj" value="valider">
			</form>
	</body>
</html>