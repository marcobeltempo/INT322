<html>
<body>
<?php
include "functions.php";
function cusSearch($cusLname){
  include "/home/int322_163d07/password/.config.php";
echo "<br />cusLname revieved bt the function is : >>>", $cusLname, "<<<<br />";
$sql_CusOrders = "SELECT * FROM fsossregister WHERE lname = '$cusLname'";
echo "<br /> sql_CusOrders to select last name SQL is : >>>", $sql_CusOrders, "<<<<br />";
  $cusOrder = mysqli_query($mysqli, $sql_CusOrders);
  displayOrderList($cusOrder);
?>
    <button onclick="location.href = 'fsoss-reg.php';"> Reutrn to Order </button><br />

  
</body>
</html>
