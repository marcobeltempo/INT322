<?php
include "password filepath";
$fname = $lname = $sex = $shirt = $multiple = $orderQty = "";
$errors= $fnameErr = $lnameErr = $sexErr = $shirtErr = $selectionErr = $qtyErr ="";

if(isset($_POST['submit'])){
   if(isset($_GET['go'])){

$order = $_POST['lname'];

//echo "<br />cusLname revieved from search function is : >>>", $cusLname, "<<< <br />";

$sql_CusOrders = "SELECT * FROM fsossregister WHERE lname = '$order'";
//echo "<br /> sql_CusOrders to select last name SQL is : >>>", $sql_CusOrders, "<<< <br />";
$cusOrder = mysqli_query($mysqli, $sql_CusOrders) or die('query failed'. mysqli_error($mysqli));

if(!mysqli_num_rows($cusOrder)){
  echo "<---Error No Orders Found With Last Name: $order --->";
  ?>
  <button onclick="history.go(-1);">Back </button>
  <?php
} else{
  echo "Here is a list of orders for: $order  ";
  ?>
  <button onclick="history.go(-1);">Back </button> <br />
  <html>
  <body>
  <table border="1">
    <tr>
     <th>Order Id</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Sex</th>
     <th>Size</th>
     <th>Multiple</th>
     <th>Qty.</th>
     <th> Add / Cancel </th>

  <?php
  while($row = mysqli_fetch_assoc($cusOrder))
{
  ?>
  <tr>
  <td><?php  print $row['orderId']; ?></td>
  <td><?php print $row['fname']; ?></td>
  <td><?php print $row['lname']; ?></td>
  <td><?php print $row['sex']; ?></td>
  <td><?php print $row['size']; ?></td>
  <td><?php print $row['multiple']; ?></td>
  <td><?php print $row['orderQty']; ?></td>
  <td><a href="editOrder.php?delete= <?php echo $row['orderId']; ?>" >Delete row </a> </td>

  </tr>

  <?php
  }
  ?>
  </table>
<?php

}
}
}?>

</body>
</html>
