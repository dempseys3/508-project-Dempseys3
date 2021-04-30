<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT workout_id, class_id
                        FROM logged_classes");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Workout ID</th><th>Class ID</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[workout_id]</td><td>$row[class_id]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>