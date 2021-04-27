<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT *
                        FROM manages");
                        
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[manager_ID]</td><td>$row[employee_ID]</td><tr>";
    
}

echo "</tbody>";
echo "</table>";

?>