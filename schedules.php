<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT schedule_ID, start_date, end_date
                        FROM schedules");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Schedule ID</th>
      <th>Start Date</th>
      <th>End Date</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[schedule_ID]</td>
          <td>$row[start_date]</td>
          <td>$row[end_date]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>