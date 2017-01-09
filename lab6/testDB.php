<?php

require "myClasses.php";
$qry    = "SELECT * FROM cellphoneSpecs WHERE model LIKE '%Samsung%';";
$mysqli = new DBLink();
$mysqli->query("DELETE FROM cellphoneSpecs WHERE model = 'Samsung Galaxy S8';");
$mysqli->query("UPDATE cellphoneSpecs SET model='Samsung Galaxy S7' WHERE model='*Samsung Galaxy S7 RECALLED*'; ");

echo "Looking for all Samsung devices... <br>";
$result1 = $mysqli->query($qry);

echo "<br>We found " . $mysqli->isEmptyResult() . " devices <br><br>";

printTable($result1);

echo "<br>*****MEMO*****<br>
      Samsung S8 Announced!<br>
      Updating database...<br>";

$result2 = $mysqli->query("INSERT INTO cellphoneSpecs (model) VALUES ('Samsung Galaxy S8'); ");

echo "<br>Success! Samsung S8 succesfully added.<br>";

$result1 = $mysqli->query($qry);
printTable($result1);

echo "<br>*****IMPORTANT*****<br>
      Samsung S7 Recall Notice <br>
      Please stop sales on all Galaxy S7's <br>
      Updating database...<br>";

$result2 = $mysqli->query("UPDATE cellphoneSpecs SET model= '*Samsung Galaxy S7 RECALLED*' WHERE model='Samsung Galaxy S7'; ");

$result1 = $mysqli->query($qry);
printTable($result1);

function printTable($results) {
?>
<br>
<table>
      <tr>
        <th>Model</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($results))  { ?>
      <tr>
        <td><?php  print $row['model']; ?></td>
      </tr>
      <?php } ?>
      </tr>
  </table>
  <br>
<?php }
?>
