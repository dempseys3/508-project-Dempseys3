<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT branch_id, CONCAT(street_address, ' ', city, ' ', branch_state, ' ', zip_code) AS 'Address'
                        FROM branches");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Branch ID</th>
      <th>Address</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[branch_id]</td>
          <td>$row[Address]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>