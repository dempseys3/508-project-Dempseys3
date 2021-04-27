<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT u.user_ID, first_name, last_name, type, phone_number
                        FROM user_phone_numbers un JOIN users u USING(user_ID)");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[user_id]</td><td>$row[first_name]</td><td>$row[last_name]</td></td>$row[type]
         </td><td>$row[phone_number]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>