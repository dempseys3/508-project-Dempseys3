<?php

require_once('connection.php');

if (!isset($_GET['branch_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT branch_id, street_address, city, branch_state, zip_code FROM branches");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='branch_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[branch_id]'>$row[branch_ID] $row[street_address] $row[city] $row[branch_state] $row[zip_code]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $branch_id = $_GET['branch_id'];
    
    $stmt = $conn->prepare("SELECT branch_id, street_address, city, branch_state, zip_code FROM branches WHERE branch_id=:branch_id");
    
    $stmt->bindValue(':branch_id', $branch_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-branches.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Branch ID</td><td><input name='branch_id' type='text' size='25' value='$row[branch_id]'></td></tr>";
    echo "<tr><td>Street Address</td><td><input name='street_address' type='text' size='25' value='$row[street_address]'></td></tr>";
    echo "<tr><td>City</td><td><input name='city' type='text' size='25' value='$row[city]'></td></tr>";
    echo "<tr><td>State</td><td><input name='branch_state' type='text' size='25' value='$row[branch_state]'></td></tr>";
    echo "<tr><td>Zip Code</td><td><input name='zip_code' type='text' size='25' value='$row[zip_code]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION['editBranch_branch_id'] = $branch_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE branches SET street_address=:street_address, city=:city, branch_state=:branch_state, 
                                zip_code=:zip_code WHERE branch_id=:branch_id");
        
        $stmt->bindValue(':street_address', $_POST['street_address']);
        $stmt->bindValue(':city', $_POST['city']);
        $stmt->bindValue(':branch_state', $_POST['branch_state']);
        $stmt->bindValue(':zip_code', $_POST['zip_code']);
        $stmt->bindValue(':branch_id', $_SESSION['editBranch_branch_id']);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION['editBranches_branch_id']);
    
    echo "Success";
}

?>