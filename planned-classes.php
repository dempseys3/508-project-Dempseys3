<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT p.plan_id 
                        FROM planned_classes p JOIN classes c USING(class_ID) JOIN fitness_plans f USING(plan_ID) JOIN users u ON 
                        f.member_ID = u.user_ID
                        WHERE f.member_ID = u.user_id AND c.class_id = p.class_ID AND f.plan_ID = p.plan_ID");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[user_id]</td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[email]</td></td>$row[type]
         </td><td>$row[address]</td><td>$row[city]</td><td>$row[user_state]</td><td>$row[zip_code]</td><td>$row[birthday]
         </td><td>$row[type]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>