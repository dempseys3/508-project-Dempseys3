<?php 

require_once ('connection.php');

$stmt = $conn->prepare("SELECT user_id, first_name, last_name, email, type, address, city, user_state, zip_code, birthday
                        FROM users
                        WHERE type = 'Member'
                        ORDER BY first_name, last_name");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while($row = $stmt->fetch()){
    echo "<tr><td>$row[user_id]</td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[email]</td></td>$row[type]
         </td><td>$row[address]</td><td>$row[city]</td><td>$row[user_state]</td><td>$row[zip_code]</td></td>$row[birthday]
         </td><td>$row[type]</td></tr>";
    
}

echo "</tbody>";
echo "</table>";

?>