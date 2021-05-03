<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT f.member_id, CONCAT(u.first_name, ' ' , u.last_name) AS 'Name', f.workouts, f.meal_plan, f.trainer_id, 
                        f.class_id, c.class_name
                        FROM fitness_plans f JOIN classes c USING(class_id) JOIN users u ON u.user_id = f.member_id
                        WHERE u.user_id = f.member_id AND c.class_id = f.class_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Member ID</th><th>Name</th><th>Workout</th><th>Meal plan</th><th>Trainer ID</th><th>Class ID</th><th>Class name</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[member_id]</td><td>$row[Name]</td><td>$row[workouts]</td><td>$row[meal_plan]</td><td>$row[trainer_id]
         </td><td>$row[class_id]</td><td>$row[class_name]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>