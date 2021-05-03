<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT user_id, CONCAT(first_name, ' ', last_name) AS 'Name', email, address, city, user_state, zip_code, birthday
                        FROM users
                        WHERE type = 'Member'
                        ORDER BY first_name, last_name");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Member ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>City</th>
      <th>State</th>
      <th>Zip Code</th>
      <th>Birthday</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[user_id]</td><td>$row[Name]</td><td>$row[email]</td><td>$row[address]</td><td>$row[city]</td>
          <td>$row[user_state]</td><td>$row[zip_code]</td><td>$row[birthday]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>