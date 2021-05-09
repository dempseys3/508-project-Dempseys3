<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>

<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-branch.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Address</td><td><input name='street_address' type='text' size='25'></td></tr>";
    echo "<tr><td>City</td><td><input name='city' type='text' size='25'></td></tr>";
    echo "<tr><td>State</td><td><input name='branch_state' type='text' size='25'></td></tr>";
    echo "<tr><td>Zip code</td><td><input name='zip_code' type='text' size='25'></td></tr>";
    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO branches(street_address, city, branch_state, zip_code)
                                VALUES (:street_address, :city, :branch_state, :zip_code)");

        $stmt->bindValue(':street_address', $_POST['street_address']);
        $stmt->bindValue(':city', $_POST['city']);
        $stmt->bindValue(':branch_state', $_POST['branch_state']);
        $stmt->bindValue(':zip_code', $_POST['zip_code']);
        


        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>