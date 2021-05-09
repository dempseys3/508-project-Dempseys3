<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-phone-number.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>6-Digit User ID</td><td><input name='user_id' type='number' size='25'></td></tr>";
    echo "<tr><td>Phone Number</td><td><input name='phone_number' type='tel' size='25'></td></tr>";

    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO user_phone_numbers(user_id, phone_number)
                                VALUES (:user_id, :phone_number)");

        $stmt->bindValue(':user_id', $_POST['user_id']);
        $stmt->bindValue(':phone_number', $_POST['phone_number']);        

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>