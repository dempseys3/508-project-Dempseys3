<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT l.workout_id, l.class_id, c.class_name
                        FROM logged_classes l JOIN classes c USING(class_id)
                        WHERE l.class_id = c.class_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
    <th>Workout ID</th>
    <th>Class ID</th>
    <th>Class Name</th>
    </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[workout_id]</td><td>$row[class_id]</td><td>$row[class_name]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>