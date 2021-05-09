<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT w.member_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name',
                        w.workout_id, w.start_time, w.end_time, w.type, w.branch_id
                        FROM users u JOIN workouts w ON u.user_id = w.member_id 
                        WHERE u.user_id = w.member_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Member ID</th>
      <th>Name</th>
      <th>Workout ID</th>
      <th>Start time</th>
      <th>End time</th>
      <th>Type</th>
      <th>Branch ID</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[member_id]</td>
          <td>$row[Name]</td>
          <td>$row[workout_id]</td>
          <td>$row[start_time]</td>
          <td>$row[end_time]</td>
          <td>$row[type]</td>
          <td>$row[branch_id]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>