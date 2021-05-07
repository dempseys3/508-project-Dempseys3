<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT s.schedule_ID, s.start_date, s.end_date, e.employee_ID, CONCAT(u.first_name,' ',u.last_name) AS 'Name'
                        FROM schedules s JOIN employee_schedules e USING(schedule_ID) JOIN users u ON e.employee_ID = u.user_ID");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Schedule ID</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Employee ID</th>
      <th>Employee Name</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[schedule_ID]</td>
          <td>$row[start_date]</td>
          <td>$row[end_date]</td>
          <td>$row[employee_ID]</td>
          <td>$row[Name]</td>


          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>