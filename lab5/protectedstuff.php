<?php
session_start();

if (!isset($_SESSION['username']))
{
	header("location: login.php");
}

if (isset($_GET['logout']))
{
	session_unset();
	setcookie("PHPSESSID", "", time() + 61200, "/");
	session_destroy();
}
?>

<html>
<body>
	<h2>ProtectedStuff</h2>
	<hr/>
	<?php
		if (isset($_SESSION['username']))
		{
			echo $_SESSION['username'].' You are logged in!';
			echo '<hr \>';
			echo '<a href="protectedstuff.php?logout">Logout</a>';

		}
		else
		{
			echo 'You are logged out!';
			echo '<hr \>';
			echo '<a href="protectedstuff.php">Login</a>';
		}
	?>
</body>
</html>
