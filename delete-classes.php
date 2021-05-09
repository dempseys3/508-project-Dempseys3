<html>
<head>
<title>
Alpha Athletics
</title>
</head>
</html>
<?php

require_once('connection.php');

if (!isset($_GET['class_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT class_id, class_name, branch_id FROM classes");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='class_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[class_id]'>Class ID: $row[class_id], Class Name: $row[class_name] Branch ID: $row[branch_id] </option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $class_id = $_GET["class_id"];
    
    $stmt = $conn->prepare("SELECT class_id, class_name, start_time, end_time, room_num, type, branch_id, instructor_id 
                            FROM classes WHERE class_id=:class_id");
    $stmt->bindValue(':class_id', $class_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='delete-classes.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Enter 6-digit Class ID to delete</td><td><input name='class_id' type='number' size='25' value='$row[class_id]'></td></tr>";

    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["deleteClasses_class_id"] = $class_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("DELETE FROM classes WHERE class_id=:class_id");
        
        $stmt->bindValue(':class_id', $_POST['class_id']);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["deleteClasses_class_id"]);
    
    echo "Success";
}

?>