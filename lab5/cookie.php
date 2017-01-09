<?php
date_default_timezone_set("America/Toronto");
setcookie('visit', $_COOKIE['visit'] + 1);
setcookie('time', time());

$valid = true;
$name  = $value = "";
$erName = $errValue = "";

if ($_POST)
{
	$name  = $_POST['name'];
	$value = $_POST['value'];

	if ($name == "")
	{
		$errName = "Error - please enter a name";
		$valid = false;
	}

	if ($value == "")
	{
		$errValue = "Error - please enter a value";
		$valid = false;
	}

	if ($valid)
	{
		setcookie($name, $value);
	}
}
?>

<html>
<body>
	<h2>Cookie Creator</h2>
	<hr />
	<form method="post" action="">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" value="<?php echo $name; ?>" /></td>
				<td><?php echo $errName; ?></td>
			</tr>
			<tr>
				<td>Value:</td>
				<td><input type="text" name="value" value="<?php echo $value; ?>" /></td>
				<td><?php echo $errValue; ?></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" /> <button onclick="location.href = 'cookie.php';"> Refresh </button></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</form>

	<h2>Welcome Back</h2>
	<hr />
	<?php
		if (isset($_COOKIE['visit']))
			echo "Welcome back - you visited this page " . $_COOKIE['visit'] . " times. <br />";

		if (isset($_COOKIE['time']))
			echo "Your most recent visit was on " . date('Y-m-d H:i:s', $_COOKIE['time']) . "<br />";
	?>

	<br />
	<h2>Cookie Jar</h2>
	<hr />
	<table border="1">
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
		<?php
			while (list($key, $val) = each($_COOKIE))
			{
    			echo "<tr>";
    			echo "<td>$key</td>";
    			echo "<td>$val</td>";
    			echo "</tr>";
			}
		?>
	</table>
</body>
</html>
