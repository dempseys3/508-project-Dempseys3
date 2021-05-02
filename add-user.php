<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-user.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text' size='25'></td></tr>";
    echo "<tr><td>Address</td><td><input name='address' type='text' size='25'></td></tr>";
    echo "<tr><td>City</td><td><input name='city' type='text' size='25'></td></tr>";
    echo "<tr><td>State</td><td><input name='state' type='text' size='25'></td></tr>";
    echo "<tr><td>Zip code</td><td><input name='zip_code' type='number' size='25'></td></tr>";
    echo "<tr><td>Birthday</td><td><input name='birthday' type='date' size='25'></td></tr>";
    
        
    // Retrieve list of departments
    $stmt = $conn->prepare("SELECT e.type
                            FROM users u JOIN employees e ON e.employee_id = u.user_id
                            WHERE e.employee_id = u.user_id");
    $stmt->execute();
    
    echo "<select name='department_id'>";
    
    echo "<option value='-1'>No department</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[department_id]'>$row[department_name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td>Job</td><td>";
    
    // Retrieve list of jobs
    $stmt = $conn->prepare("SELECT job_id, job_title FROM jobs");
    $stmt->execute();
    
    echo "<select name='job_id'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[job_id]'>$row[job_title]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, hire_date, job_id, salary, manager_id, department_id)
                                VALUES (:first_name, :last_name, :email, CURDATE(), :job_id, :salary, :manager_id, :department_id)");

        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':job_id', $_POST['job_id']);
        $stmt->bindValue(':salary', $_POST['salary']);
        
        if($_POST['manager_id'] != -1) {
            $stmt->bindValue(':manager_id', $_POST['manager_id']);
        } else {
            $stmt->bindValue(':manager_id', null, PDO::PARAM_INT);
        }
        
        if($_POST['department_id'] != -1) {
            $stmt->bindValue(':department_id', $_POST['department_id']);
        } else {
            $stmt->bindValue(':department_id', null, PDO::PARAM_INT);
        }
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";    
}

?>