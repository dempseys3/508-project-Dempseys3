<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT u.user_ID, first_name, last_name, type, phone_number
                        FROM user_phone_numbers un JOIN users u USING(user_ID)");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>User ID</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Type</th>
      <th>Phone number</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[user_ID]</td>
          <td>$row[first_name]</td>
          <td>$row[last_name]</td>
          <td>$row[type]</td>
          <td>$row[phone_number]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>