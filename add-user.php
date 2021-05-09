<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-user.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Password</td><td><input name='password' type='password' size='25'></td></tr>";
    echo "<tr><td>Type: Member or Employee</td><td><input name='type' type='text' size='25'></td></tr>";
    echo "<tr><td>Address</td><td><input name='address' type='text' size='25'></td></tr>";
    echo "<tr><td>City</td><td><input name='city' type='text' size='25'></td></tr>"; 
    echo "<tr><td>State</td><td><input name='user_state' type='text' size='25'></td></tr>";
    echo "<tr><td>Zip Code</td><td><input name='zip_code' type='text' size='25'></td></tr>";
    echo "<tr><td>Birthday</td><td><input name='birthday' type='date' size='25'></td></tr>";
    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, type, address, city, user_state, zip_code, birthday)
                                VALUES (:first_name, :last_name, :email, :password, :type, :address, :city, :user_state, :zip_code, :birthday)");

        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $_POST['password']);
        $stmt->bindValue(':type', $_POST['type']);
        $stmt->bindValue(':address', $_POST['address']);
        $stmt->bindValue(':city', $_POST['city']);
        $stmt->bindValue(':user_state', $_POST['user_state']);
        $stmt->bindValue(':zip_code', $_POST['zip_code']);
        $stmt->bindValue(':birthday', $_POST['birthday']);

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>
