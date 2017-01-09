<html>
<head>
<script src="js/validate.php"></script>
<title>Lab4- Int322_163d07 </title>
</head>
<body>
<?php
$errors= false;
$valid = true;

include"functions.php";

if(isset($_GET['go'])){
  cusSearch();
}
else if(isset($_GET['delete']) || isset($_GET['qty']))
{

  deleteOrder();
}else  if(isset($_GET['order'])){


}
else if (isValidOrder($_POST)) {} else {
?>
	<form method="POST" action="">
	First Name:
	<input type="text" name="fname" value="<?php echo $_POST['fname'];?>">
	<?php echo $fnameErr; ?>
	<br />
	 Last Name:
	<input type="text" name="lname" value="<?php echo $_POST['lname'];?>">
	<?php  echo $lnameErr; ?>
	<br />
	<br />
	Gender:
	<input type="radio" name="sex"  value="Male"   <?php  echo ($_POST['sex'] == 'Male' ? 'checked' :'')  ?>>  Male
	<input type="radio" name="sex"  value="Female" <?php  echo ($_POST['sex'] == 'Female' ? 'checked' :'')  ?>> Female
	<?php  echo $sexErr; ?>
	<br />
	<br />
	Size:
	<select name="size">
		<option value="default"  selected> --Please choose-- </option>
		<option value="S" <?php  echo ($_POST["size"] == "S" ? "selected" :'') ?>> Small </option>
		<option value="M" <?php  echo ($_POST["size"] == "M" ? "selected" :'') ?>> Medium </option>
		<option value="L" <?php  echo ($_POST["size"] == "L" ? "selected" :'') ?>> Large </option>
		<option value="XL" <?php  echo ($_POST["size"] == "XL" ? "selected" :'') ?>> XLarge </option>
	</select>
<?php echo  $shirtErr; ?>
<br />
	Multiple Shirts:
	<input type="checkbox" name="multiple[]" id="yes_CheckBox" value="Yes" <?php if (IsChecked('multiple','Yes')){echo "checked";}?> > Yes
	<input type="checkbox" name="multiple[]" id="no_CheckBox" value="No" <?php if (IsChecked('multiple','No')){ echo "checked";}?> >No <br />
<?php echo $selectionErr; ?>
<br />

<div id="MultipleOrder"   style= " <?php echo(IsChecked('multiple','Yes') == false ? 'visibility:hidden' :'visibility:visible')  ?>" >
	Number to Order:
	<input type="text" name="orderQty" value= "<?php echo $_POST['orderQty']; ?>">
	<?php  echo $qtyErr; ?>
</div>
<br />
<input type="submit" value="Submit">
<input type="reset" value="Clear">
</form>

<?php } ?>
</body>
</html>
