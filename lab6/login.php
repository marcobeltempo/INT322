<?php
session_start();
require "myClasses.php";
$username = $password = $email = "";
$loginAttempt = new ValidateUser();
$mysqli = new DBLink();

if($_POST){
  if (isset($_POST['email']) && !isset($_POST['password']))
		{
      $loginAttempt->forgotPassword();
  }
   if ($loginAttempt->loginValidation()){

$_SESSION['$username'];
header("location: protectedstuff.php");
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
				<td><input type="text" name="username"  value="" /></td>
				<td><?php echo $loginAttempt->errorUsername; ?></td>
			</tr>
			<tr>
			<?php if (isset($_GET['forgot'])) { ?>
				<td>Email:</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
				<td><?php echo $loginAttempt->errorEmail; ?></td>
			<?php } else { ?>
				<td>Password:</td>
				<td><input type="password" name="password"  value="<?php echo $password; ?>" /></td>
				<td><br><?php echo $loginAttempt->errorPassword; ?></td>
			<?php } ?>
			</tr>
			<tr>
				<td></td>
				<td><br><?php echo $loginAttempt->errorLoginFail; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Login"/></td>
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
