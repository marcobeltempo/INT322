<?php
session_start();

$dataValid = true;
$username = "";
$password = "";
$email = "";
$errorUsername = "";
$errorPassword = "";
$errorEmail = "";
$errorLoginFail = "";

if ($_POST)
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if ($username == "")
	{
		$errorUsername = "Error - you must fill in a data";
		$dataValid = false;
	}

	if (!isset($_POST['email']) && $password == "")
	{
		$errorPassword = "Error - you must fill in a data";
		$dataValid = false;
	}

	if (!isset($_POST['password']) && $email == "")
	{
		$errorEmail = "Error - you must fill in a data";
		$dataValid = false;
	}

	if ($dataValid)
	{

		if (isset($_POST['email']))
		{
			$sql = "SELECT * FROM users where email='$email' AND username='$username'";
			$query = mysqli_query($mysqli, $sql)
							or die('query failed'. mysqli_error($mysqli));

			$rows = mysqli_num_rows($query);
			if ($rows == 1)
			{
				$row = mysqli_fetch_assoc($query);

				// Email information
				$to      = $email;
				$subject = "Password Hint";
				$message = "Username: $username" . "\r\n" .
						   "Password Hint: " . $row['passwordHint'] . "\r\n";
				$headers = "From: " . "\r\n" .
						   "Reply-To: " . "\r\n" .
						   "X-Mailer: PHP/" . phpversion();

				mail($to, $subject, $message, $headers);
				unset($_GET['forgot']);
			}
		}
		else
		{
			$sql = "SELECT * FROM users where password='$password' AND username='$username'";
			$query = mysqli_query($mysqli, $sql)
							or die('query failed'. mysqli_error($mysqli));

			$rows = mysqli_num_rows($query);
			if ($rows == 1)
			{
			return true;
			}
			else
			{
				$username = "";
				$password = "";
				$errorLoginFail = "Invalid username or password";
				return false;
			}
		}

		// Closing Connection
		mysqli_close($mysqli);
	}
}
?>

<html>
<body>
	<h2><?php echo isset($_GET['forgot']) ? "Find Password" : "Login"; ?></h2>
	<hr/>
	<form method="post" action="">
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" value="<?php echo $username; ?>" /></td>
				<td><?php echo $errorUsername; ?></td>
			</tr>
			<tr>
			<?php if (isset($_GET['forgot'])) { ?>
				<td>Email:</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
				<td><?php echo $errorEmail; ?></td>
			<?php } else { ?>
				<td>Password:</td>
				<td><input type="password" name="password" value="<?php echo $password; ?>" /></td>
				<td><?php echo $errorPassword; ?></td>
			<?php } ?>
			</tr>
			<tr>
				<td></td>
				<td><?php echo $errorLoginFail; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" /></td>
				<td></td>
			</tr>
			<tr>
			</tr>
			<?php if (!isset($_GET['forgot'])) { ?>
			<tr>
				<td></td>
				<td><a href="login.php?forgot"/>Forgot your password</td>
				<td></td>
			</tr>
			<?php } ?>
		</table>
	</form>
<body>
</html>
