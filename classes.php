<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT class_id, class_name, start_time, end_time, room_num, type, branch_id, instructor_id
                        FROM classes");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Class ID</th><th>Class name</th><th>Start time</th><th>End time</th><th>Room #</th><th>Type</th><th>Branch</th><th>Instructor</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[class_id]</td><td>$row[class_name]</td><td>$row[start_time]</td><td>$row[end_time]</td></td>$row[room_num]
         </td><td>$row[type]</td><td>$row[branch_id]</td><td>$row[instructor_id]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>