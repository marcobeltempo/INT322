<html>
<body>
	<?php

	$usernameError = "";
	$passwordError = "";
	$username = "";
	$password = "";
	$print = true;

	if($_POST) {
		if ($_POST['username'] == ""){

			$usernameError = "Error, you must enter a username.";
			$print = false;
		}
		if ($_POST['password'] == ""){

			$passwordError = "Error, you must enter a password.";
			$print = false;
		}
	}
	?>
	<form method="POST" action="">
		Username: <input type="text" name="username" value="<?php if ($_POST) echo $_POST['username']; ?>" ><?php echo $usernameError; ?>
<br/>
		Password: <input type="password" name="password" value="<?php if ($_POST) echo $_POST['password']; ?>" ><?php echo $passwordError; ?>
<br/>
		<input type="submit" value= "submit">
	</form>
	<?php
		if($_POST && $print){

			$username = $_POST['username'];
			$password = $_POST['password'];

			echo "Username: $username";
			echo "<br/>Password: $password ";
		}
		?>


</body>
</html>
