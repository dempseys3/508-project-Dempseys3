<?php

require_once('connection.php');

if (!isset($_GET['user_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name FROM users ORDER BY first_name, last_name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='user_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[user_id]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $user_id = $_GET["user_id"];
    
    $stmt = $conn->prepare("SELECT first_name, last_name, email, address FROM users WHERE user_ID=:user_id");
    $stmt->bindValue(':user_id', $user_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-user.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25' value='$row[first_name]'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25' value='$row[last_name]'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25' value='$row[email]'></td></tr>";
    echo "<tr><td>Address</td><td><input name='address' type='text' size='25' value='$row[address]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editUser_user_id"] = $user_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, address=:address WHERE user_id=:user_id");
        
        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':address', $_POST['address']);
        $stmt->bindValue(':user_id', $_SESSION["editUser_user_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editUser_user_id"]);
    
    echo "Success";
}

?>