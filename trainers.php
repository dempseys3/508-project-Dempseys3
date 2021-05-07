<?php

require_once ('connection.php');

$stmt = $conn->prepare("SELECT CONCAT(u.first_name, ' ', u.last_name) AS 'Name', email, e.type
                        FROM users u JOIN employees e ON e.employee_id = u.user_id
                        WHERE e.type = 'Personal Trainer'
                        ORDER BY first_name, last_name");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Name</th>
      <th>Email</th>
      <th>Type</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[Name]</td>
          <td>$row[email]</td>
          <td>$row[type]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>