<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT m.manager_id
                        FROM manages m JOIN users u ON u.user_id = m.manager_id
                        WHERE u.user_id = m.manager_id
                        UNION
                        SELECT m.employee_id 
                        FROM manages m JOIN users u ON u.user_id = m.employee_id
                        WHERE u.user_id = m.employee_id");
                        
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