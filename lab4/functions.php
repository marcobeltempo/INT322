<?php

$fname = $lname = $sex = $shirt = $multiple = $orderQty = "";
$fnameErr = $lnameErr = $sexErr = $shirtErr = $selectionErr = $qtyErr ="";

function IsChecked($chkname,$value) {
  if(!empty($_POST[$chkname])) {
    if(count($chkname) == 1) {
      foreach($_POST[$chkname] as $chkval) {
        if($chkval == $value) {
          return true;
        }
      }
    }
    return false;
  }
  return false;
}//end of ISchecked function

function isValidOrder($valid){
if ($_POST){
		if ($_POST['fname']  == "") {
  global $fnameErr;
  $fnameErr = " <br/> Error, please enter a first name.  ";
      $valid = false;
		}
 $_POST['lname'] ;
		if ($_POST['lname'] == "") {
			global $lnameErr;
      $lnameErr = " <br/> Error, please enter a last name.  ";
			$valid = false;
		}

		if (empty($_POST['sex'])) {
global $sexErr;
      $sexErr = "<br /> Error, Please select a gender.";
			$valid = false;
		}

		if($_POST['size'] == "default"){
      global $shirtErr;
			 $shirtErr = "<br /> Error, please select a T-Shirt size. <br/ >";
			$valid = false;
		}

		if(empty($_POST['multiple'])){
		global $selectionErr;
    $selectionErr  = "<br /> Error, order multiple shirts? <br/>";
			$valid = false;
		}

		/* Double check option blocked by validte.php javascript
		 if(count($multiple) > 1){
	   $selectionErr = "<br /> Error, you can only select one box. <br/>";
		 $valid = false; }*/

     if(IsChecked('multiple','Yes')){
 			$order= 'Yes';

 		}

 		if(IsChecked('multiple','No')){
 			$order= 'No';
 		}

		if ($order == "Yes" && empty($_POST['orderQty'])){
global $qtyErr;
    	$qtyErr ="<br /> Error, please enter order amount. <br/>";
			$valid = false;
		}

		if($order == "Yes" && !is_numeric($_POST['orderQty'])){
global $qtyErr;
      $qtyErr ="<br /> Error, order quantity must be a number. <br/>";
			$valid = false;
		}
    $orderQty = $_POST['orderQty'];


    include "password filepath";

    $img=mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT stock FROM fsossregister"));
    $stock= $img["stock"];
    //echo "stock level>>".$stock;
    if($orderQty > $stock ){
    global $qtyErr;
    $qtyErr = "You've order is larger than our quantity on hand of $stock pcs.<br />";
    $valid = false;
}

//echo $orderQty;
   if($valid){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $sex = $_POST['sex'];
  $multiple= $_POST['multiple'];
   $shirt = $_POST['size'];
   $orderQty = $_POST['orderQty'];
  // echo $order;
   if($order === "No"){
     $orderQty = 1;

   }
//echo $orderQty;
submitOrder($fname, $lname, $sex, $shirt, $order, $orderQty);
    }
return $valid;
}
}// end of valid order

function submitOrder($fname, $lname, $sex, $shirt, $order, $orderQty){
    include "password filepath";

    $insertQry = "INSERT INTO fsossregister (fname, lname, sex, size, multiple, orderQty) VALUES ('$fname', '$lname', '$sex', '$shirt', '$order', '$orderQty')";
    $insertMyQry  = mysqli_query($mysqli, $insertQry) or die('query failed'. mysqli_error($mysqli));
    $stockQry=mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT stock FROM fsossregister"));
    $stock= $stockQry["stock"];
    $updateQry = "UPDATE fsossregister SET stock = $stock- $orderQty";
    mysqli_query($mysqli, $updateQry ) or die('query failed'. mysqli_error($mysqli));

    $fullTblQry = "SELECT * FROM fsossregister WHERE orderID > 0";
    $tblDisplay = mysqli_query($mysqli,$fullTblQry ) or die('query failed'. mysqli_error($mysqli));

  echo "<br/> $fname $lname, your order was successfully submitted! <br /><br />";

displayOrderList( $tblDisplay);

mysqli_close($mysqli);

}//end submitOrderFunction



function displayOrderList($result){

    ?>
    <form method="POST" action="fsoss-reg.php?go">
      <input type="text" name="lastname" placeholder="Search..">
      <input type="submit" name="submit" value="Search">
      	<button onclick="history.go(-1);"> Reutrn to Order Menu </button>

    </form>
  <table border="1">
  <tr>
  <th>Order Id</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Sex</th>
  <th>Size</th>
  <th>Multiple</th>
  <th>Qty.</th>
  <th>Stock</th>
  <th>Cancel </th>

  <?php
  while($row = mysqli_fetch_assoc($result))  { ?>
  <tr>
  <td><?php  print $row['orderId']; ?></td>
  <td><?php  print $row['fname']; ?></td>
  <td><?php  print $row['lname']; ?></td>
  <td><?php  print $row['sex']; ?></td>
  <td><?php  print $row['size']; ?></td>
  <td><?php  print $row['multiple']; ?></td>
  <td><?php  print $row['orderQty']; ?></td>
  <td><?php  print $row['stock']; ?></td>
  <td><a href="fsoss-reg.php?delete=<?php echo $row['orderId'] ?>" >Cancel Order</a>  </td>

  </tr>

  <?php
  } ?>
  </table>
  <?php

}// END FUNCTION displayOrderList

function cusSearch(){
  include "password filepath";

  $order = $_POST['lastname'];
  $sql_CusOrders = "SELECT * FROM fsossregister WHERE lname = '$order'";
  $cusOrder = mysqli_query($mysqli, $sql_CusOrders) or die('query failed'. mysqli_error($mysqli));

  if(!mysqli_num_rows($cusOrder)){
    echo "<---Error No Orders Found With Last Name: $order --->";
    ?>
    <button onclick="history.go(-1);">Back </button>

    <?php
  } else{
    echo "Here is a list of orders for: $order  <br /><br />";
    ?>
      <?php  displayOrderList($cusOrder);
?>

<br/>
<br/>
<br/>
<br/>

 <?php
}
mysqli_close($mysqli);
}// END cusSearch() function

function deleteOrder(){
  include "/home/int322_163d07/password/.config.php";

  if(isset($_GET['delete'])){

//Gets the current stock
    $stockQry = "SELECT stock FROM fsossregister";
    $stockMyQry = mysqli_query($mysqli, $stockQry) or die(mysqli_error($mysqli));
    $row_stockMyQry = mysqli_fetch_assoc($stockMyQry);
    $img = $row_stockMyQry['stock'];

//Gets the orignal order quantity from the canceled entry
    $orderQry = "SELECT * FROM fsossregister WHERE orderId =".$_GET['delete'];
    $orderMyQry= mysqli_query($mysqli, $orderQry) or die(mysqli_error($mysqli));
    $row=mysqli_fetch_assoc($orderMyQry);

    //update the stock with the canceled orderQty
    $updateQry = "UPDATE fsossregister SET stock =".$img."+".$row['orderQty'];
    mysqli_query($mysqli, $updateQry) or die('query failed'. mysqli_error($mysqli));

    //finally delete requested entry
    $deleteQry="DELETE FROM fsossregister WHERE orderId =".$_GET['delete'];
    mysqli_query($mysqli,  $deleteQry) or die('query failed'. mysqli_error($mysqli));


echo "<br />Order Canceled Succesfully<br />";
print "The update stock is ".$img. " <br />"; //current stock

}
		?>
		<br />
		<br />
		<button onclick="location.href = 'fsoss-reg.php';"> Reutrn to Order Menu </button>
		<br />
<?php
  mysqli_close($mysqli);
 }

?>
