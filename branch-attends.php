<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT a.member_id, CONCAT(u.first_name, ' ', u.last_name) AS name, b.branch_id, b.city
                        FROM branch_attends a JOIN users u ON a.member_id = u.user_id 
                        JOIN branches b ON b.branch_id = a.branch_id
                        WHERE a.branch_id = b.branch_id AND u.user_id = a.member_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Member ID</th>
      <th>Name</th>
      <th>Branch ID</th>
      <th>City</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[member_id]</td>
          <td>$row[name]</td>
          <td>$row[branch_id]</td>
          <td>$row[city]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>