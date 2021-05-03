<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT c.class_id, c.class_name, c.start_time, c.end_time, c.room_num, c.type, c.branch_id,
                        CONCAT(u.first_name, ' ', u.last_name) AS 'Name'
                        FROM classes c JOIN users u ON c.instructor_id = u.user_id ");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
    <th>Class ID</th>
    <th>Class name</th>
    <th>Start time</th>
    <th>End time</th>
    <th>Room #</th>
    <th>Type</th>
    <th>Branch</th>
    <th>Instructor Name</th>
    </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[class_id]</td><td>$row[class_name]</td><td>$row[start_time]</td><td>$row[end_time]</td><td>$row[room_num]
         </td><td>$row[type]</td><td>$row[branch_id]</td><td>$row[Name]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>