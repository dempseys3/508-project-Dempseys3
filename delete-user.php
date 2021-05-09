<html>
<head>
<title>
Alpha Athletics
</title>
</head>
</html>
<?php

require_once('connection.php');

if (!isset($_GET['user_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name FROM users ORDER BY first_name, last_name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='user_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[user_id]'>$row[user_id], $row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $user_id = $_GET["user_id"];
    
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name, email, address FROM users WHERE user_id=:user_id");
    $stmt->bindValue(':user_id', $user_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='delete-user.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Enter 6-digit User ID to delete</td><td><input name='user_id' type='text' size='25' value='$row[user_id]'></td></tr>";

    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["deleteUser_user_id"] = $user_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=:user_id");
        
        $stmt->bindValue(':user_id', $_POST['user_id']);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["deleteUser_user_id"]);
    
    echo "Success";
}

?>