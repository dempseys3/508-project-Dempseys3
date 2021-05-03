<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT e.employee_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name', schedule_ID
                        FROM employee_schedules e JOIN users u ON e.employee_id = u.user_id 
                        JOIN employees es ON u.user_id = es.employee_id
                        WHERE e.employee_id = es.employee_id
                        ORDER BY e.employee_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>Employee Name</th><th>Schedule ID</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[employee_id]</td><td>$row[Name]</td><td>$row[schedule_ID]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>