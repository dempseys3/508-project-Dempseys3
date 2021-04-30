<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT e.employee_id, u.first_name, u.last_name, b.city
                        FROM branch_employees e JOIN users u ON e.employee_ID = u.user_id JOIN branches b USING(branch_ID)
                        WHERE e.employee_id = u.user_ID AND b.branch_ID = e.branch_id ");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th><th>City</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[employee_id]</td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[city]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>