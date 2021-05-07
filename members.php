<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT user_id, CONCAT(first_name, ' ', last_name) AS 'Name', height, weight, email,
                        CONCAT(address, ' ', city, ', ', user_state, ' ', zip_code) AS 'Address', birthday
                        FROM users u JOIN members m ON(u.user_id = m.member_id)
                        ORDER BY user_id");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Member ID</th>
      <th>Name</th>
      <th>Height in cm</th>
      <th>Weight</th>
      <th>Email</th>
      <th>Address</th>
      <th>Birthday</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[user_id]</td>
          <td>$row[Name]</td>
          <td>$row[height]</td>
          <td>$row[weight]</td>
          <td>$row[email]</td>
          <td>$row[Address]</td>
          <td>$row[birthday]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>