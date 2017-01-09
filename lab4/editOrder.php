<?php

	include "password filepath";

	if(isset($_GET['delete'])){
		$qry="DELETE FROM fsossregister WHERE orderId =".$_GET['delete'];
		mysqli_query($mysqli, $qry) ;
		echo "Order Canceled Succesfully";
		?>
		<br />
		<br />
		<button onclick="location.href = 'fsoss-reg.php';"> Reutrn to Order Menu </button>
		<br />
<?php
 } ?>
