<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT m.user_id AS m_user_id, CONCAT(m.first_name, ' ', m.last_name) AS man_name, e.user_id AS e_user_id,
                        CONCAT(e.first_name, ' ', e.last_name) AS emp_name
                        FROM users e JOIN manages ON (e.user_ID = manages.employee_ID)
                        JOIN users m ON (m.user_ID = manages.manager_ID)");
                        
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr>
      <th>Manager ID</th>
      <th>Manager Name</th>
      <th>Employee ID</th>
      <th>Employee Name</th>
      </tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr>
          <td>$row[m_user_id]</td>
          <td>$row[man_name]</td>
          <td>$row[e_user_id]</td>
          <td>$row[emp_name]</td>
          <tr>";
    
}

echo "</tbody>";
echo "</table>";

?>