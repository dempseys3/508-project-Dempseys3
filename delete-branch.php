<html>
<head>
<title>
Alpha Athletics
</title>
</head>
</html>
<?php

require_once('connection.php');

if (!isset($_GET['branch_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT branch_id, CONCAT(street_address, ' ', city, ' ', branch_state, ' ', zip_code) AS 'Address'
                            FROM branches");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='branch_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[branch_id]'> Branch ID: $row[branch_id], Branch Address: $row[Address] </option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $branch_id = $_GET["branch_id"];
    
    $stmt = $conn->prepare("SELECT branch_id, street_address, city, branch_state, zip_code FROM branches WHERE branch_id=:branch_id");
    $stmt->bindValue(':branch_id', $branch_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='delete-branch.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Enter 6-digit Branch ID to delete</td><td><input name='branch_id' type='number' size='25' value='$row[branch_id]'></td></tr>";

    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["deleteBranches_branch_id"] = $branch_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("DELETE FROM branches WHERE branch_id=:branch_id");
        
        $stmt->bindValue(':branch_id', $_POST['branch_id']);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["deleteBranches_branch_id"]);
    
    echo "Success";
}

?>