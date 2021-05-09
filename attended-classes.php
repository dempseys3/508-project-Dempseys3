<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT a.member_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name', c.class_id, c.class_name
                        FROM attended_classes a JOIN classes c USING(class_id) JOIN users u ON u.user_id = a.member_id
                        WHERE a.member_id = u.user_id AND c.class_id = a.class_id");

$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Member ID</th>
      <th>Name</th>
      <th>Class ID</th>
      <th>Class Name</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[member_id]</td>
          <td>$row[Name]</td>
          <td>$row[class_id]</td>
          <td>$row[class_name]</td>
          </tr>";
    
}

echo "</tbody>";
echo "</table>";

?>