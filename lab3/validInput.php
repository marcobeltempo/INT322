<html>
<body>

<?php
$isValid = false;
$postalCode = $courseCode = $phone = "";
$postalCodeError = $courseCodeError = $phoneError = "";
$isValid_course = $isValid_postal = $isValid_phone = false;
$validPostalCode = '/^\s*([a-zA-Z]\d[a-zA-Z])\s?(\d[a-zA-Z]\d)\s*$/'; 
$validCourseCode = '/^\s*([A-Z]{3})(\d{3})([A-Z]{1,3})\s*$/';
$validPhone = '/^\s*(\(\d{3}\)\s{1}|\d{3}(-|\s)?)([0-9]{3}(-|\s)?)(-|\s)?([0-9]{4})\s*$/';

if ($_POST)
{
	if ($_POST['postalcode'] == "")
	{
		$postalCodeError = " <br/> Error, you must enter a postal code. <br/> ";
	}
	else
	{
		$postalCode = $_POST['postalcode'];

		if (preg_match($validPostalCode, $postalCode, $cusArray))
		{
			$isValid_postal = true;
		}
		else
		{
			$postalCodeError = "
              <br/> Error, postal code must be in the following formats:                                                 
              <br/>
              <br/> X9X9X9                                               
              <br/>X9X 9X9 
              <br/> ";
		}
	}

	if ($_POST['coursecode'] == "")
	{
		$courseCodeError = "
              <br/> Error, you must enter a course code. 
              <br/> ";
	}
	else
	{
		$courseCode = $_POST['coursecode'];
		if (preg_match($validCourseCode, $courseCode, $cusArray))
		{
			$isValid_course = true;
		}
		else
		{
			$courseCodeError = "
              <br/> Error, course code must be in one of the following formats:                                                                                                          
              <br/>
              <br/>XXX999X                                                                                                         
              <br/>XXX999XX                                                                                                       
              <br/> XXX999XXX
              <br/>";
		}
	}

	if ($_POST['phonenumber'] == "")
	{
		$phoneError = "
              <br/> Error, you must enter a phone number. 
              <br/> ";
	}
	else
	{
		$phone = $_POST['phonenumber'];
		if (preg_match($validPhone, $phone))
		{
			$isValid_phone = true;
		}
		else
		{
			$phoneError = "
              <br/> Error, the phone number must be in one of the following formats:                     
              <br/>
              <br/> 999-999-9999                      
              <br/> 999 999 9999                      
              <br/> 999 999-9999                     
              <br/> 9999999999                      
              <br/> 999 9999999                   
              <br/> (999) 999-9999                      
              <br/> (999) 999 9999 
              <br/>
              <br/>";
		}
	}
}

if (!$isValid_course || !$isValid_postal || !$isValid_phone)
	{
?>

   <form method="POST" action="">
            Postal Code:
            <input type="text" name="postalcode" value="<?php if ($_POST) echo $_POST['postalcode']; ?>">
            <?php echo $postalCodeError; ?>
                <br/> Course Code:
                <input type="text" name="coursecode" value="<?php if ($_POST) echo $_POST['coursecode']; ?>">
                <?php  echo $courseCodeError; ?>
                    <br/> Phone Number:
                    <input type="text" name="phonenumber" value="<?php if ($_POST) echo $_POST['phonenumber']; ?>">
                    <?php echo $phoneError; ?>
                        <input type="submit" value="submit">
        </form>

<?php
}

if ($_POST && $isValid_course && $isValid_postal && $isValid_phone)
	{

	$contactInfo = array(
		"Postal Code: " => "$postalCode",
		"Course Code: " => "$courseCode",
		"Phone Number: " => "$phone"
	);
	echo '<pre>';
	print_r($contactInfo);
	echo '</pre>';
	}
?>

  </body>
</html>
