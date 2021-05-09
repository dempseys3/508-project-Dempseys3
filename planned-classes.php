<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT p.plan_id, u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name', c.class_id, c.class_name
                        FROM planned_classes p JOIN classes c USING(class_ID) JOIN fitness_plans f USING(plan_ID) JOIN users u ON 
                        f.member_ID = u.user_ID
                        WHERE f.member_ID = u.user_id AND c.class_id = p.class_ID AND f.plan_ID = p.plan_ID");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Plan ID</th>
      <th>User ID</th>
      <th>Member name</th>
      <th>Class ID</th>
      <th>Class name</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[plan_id]</td>
          <td>$row[user_id]</td>
          <td>$row[Name]</td>
          <td>$row[class_id]</td>
          <td>$row[class_name]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>