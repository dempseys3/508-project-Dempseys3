<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='class-signup.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>6-Digit user ID</td><td><input name='user_id' type='number' size='6'></td></tr>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Class name</td><td><input name='address' type='text' size='25'></td></tr>";
    
    $stmt = $conn->prepare("SELECT class_name, type FROM classes");
    $stmt->execute();
    
    echo "<select name='class_name'>";
    
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[class_name]'>Name of class:  $row[class_name]   Type of class: $row[type]</option>";
    }
    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO class_signup (user_ID, first_name, last_name, email, class_name)
                                VALUES (:user_ID, :first_name, :last_name, :email, :class_name");

        $stmt->bindValue(':user_ID', $_POST['user_ID']);
        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':class_name', $_POST['class_name']);
  

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>