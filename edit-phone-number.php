<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php

require_once('connection.php');

if (!isset($_GET['user_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT user_id, CONCAT(first_name,' ', last_name) AS 'Name', phone_number
                            FROM user_phone_numbers JOIN users u USING(user_id)
                            ORDER BY user_id");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='user_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[user_id]'>$row[user_id] $row[Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $user_id = $_GET["user_id"];
    
    $stmt = $conn->prepare("SELECT u.user_id, CONCAT(first_name,' ', last_name) AS 'Name', phone_number
                            FROM user_phone_numbers e JOIN users u USING(user_id) WHERE user_id=:user_id");
    $stmt->bindValue(':user_id', $user_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-phone-number.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>User ID</td><td><input name='user_id' type='number' size='25' value='$row[user_id]'></td></tr>";
    echo "<tr><td>User Name</td><td><input name='Name' type='text' size='25' value='$row[Name]'></td></tr>";
    echo "<tr><td>Phone Number</td><td><input name='phone_number' type='text' size='25' value='$row[phone_number]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editPhone_user_id"] = $user_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE user_phone_numbers SET phone_number=:phone_number WHERE user_id=:user_id");
        
        $stmt->bindValue(':phone_number', $_POST['phone_number']);
 
        $stmt->bindValue(':user_id', $_SESSION["editPhone_user_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editPhone_user_id"]);
    
    echo "Success";
}

?>