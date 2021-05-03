<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT e.employee_id, u.first_name, u.last_name, schedule_ID, es.type
                        FROM employee_schedules e JOIN users u ON e.employee_id = u.user_id 
                        JOIN employees es ON u.user_id = es.employee_id
                        WHERE e.employee_id = es.employee_id
                        ORDER BY e.employee_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th><th>Schedule ID</th><th>Type</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[employee_id]</td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[schedule_ID]</td><td>$row[type]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>