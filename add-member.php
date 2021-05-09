<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>

<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-member.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First Name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Height in cm</td><td><input name='height' type='number' size='25'></td></tr>";
    echo "<tr><td>Weight</td><td><input name='weight' type='number' size='25'></td></tr>";    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO members(date_joined, height, weight)
                                VALUES (CURDATE(), :height, :weight)");

        $stmt->bindValue(':height', $_POST['height']);
        $stmt->bindValue(':weight', $_POST['weight']);        

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>