<?php
require "myClasses.php";

$address = array(
'<br>Address<br>
<input type="text" name="address"><br> ',
'<br>Province<br>
<select>
	<option value="AB">Alberta</option>
	<option value="BC">British Columbia</option>
	<option value="MB">Manitoba</option>
	<option value="NB">New Brunswick</option>
	<option value="NL">Newfoundland and Labrador</option>
	<option value="NS">Nova Scotia</option>
	<option value="ON">Ontario</option>
	<option value="PE">Prince Edward Island</option>
	<option value="QC">Quebec</option>
	<option value="SK">Saskatchewan</option>
	<option value="NT">Northwest Territories</option>
	<option value="NU">Nunavut</option>
	<option value="YT">Yukon</option>
</select><br> 	',
'<br>Postal Code<br>
<input type="text" name="postalcode"><br> '
);

$addressList = list($street, $province, $postalcode) = $address;
$menu = new Menu($addressList);

?>
