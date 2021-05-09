<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT p.member_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name', p.payment_id, p.dollar_amount, p.payment_time
                        FROM payments p JOIN users u ON p.member_id = u.user_id
                        WHERE p.member_id = u.user_id");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>ID</th>
      <th>Name</th>
      <th>Payment ID</th>
      <th>Dollar amount</th>
      <th>Time</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[member_id]</td>
          <td>$row[Name]</td>
          <td>$row[payment_id]</td>
          <td>$row[dollar_amount]</td>
          <td>$row[payment_time]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>