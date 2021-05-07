<?php

require_once('connection.php');

if (!isset($_GET['employee_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT employee_id, CONCAT(first_name,' ', last_name) AS 'Name', e.type 
                            FROM employees e JOIN users u ON u.user_id = e.employee_id 
                            ORDER BY employee_id");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='employee_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[employee_id]'>$row[employee_id] $row[Name] $row[type]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $employee_id = $_GET["employee_id"];
    
    $stmt = $conn->prepare("SELECT employee_id, CONCAT(first_name,' ', last_name) AS 'Name', e.type 
                            FROM employees e JOIN users u ON employee_id = user_id WHERE employee_ID=:employee_id");
    $stmt->bindValue(':employee_id', $employee_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-employee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Employee ID</td><td><input name='employee_id' type='number' size='25' value='$row[employee_id]'></td></tr>";
    echo "<tr><td>Employee Name</td><td><input name='Name' type='text' size='25' value='$row[Name]'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text' size='25' value='$row[type]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editEmployee_employee_id"] = $employee_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE employees SET type=:type WHERE employee_id=:employee_id");
        
        $stmt->bindValue(':type', $_POST['type']);
        $stmt->bindValue(':employee_id', $_SESSION["editEmployee_employee_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editEmployee_employee_id"]);
    
    echo "Success";
}

?>