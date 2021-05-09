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
    $stmt = $conn->prepare("SELECT class_id, class_name, start_time FROM classes ORDER BY class_id");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='class_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[class_id]'>$row[class_name] $row[start_time]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $class_id = $_GET["class_id"];
    
    $stmt = $conn->prepare("SELECT class_id, class_name, start_time, end_time, room_num, type, branch_id, instructor_id FROM classes WHERE class_id=:class_id");
    $stmt->bindValue(':class_id', $class_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-classes.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Class ID</td><td><input name='class_id' type='text' size='25' value='$row[class_id]'></td></tr>";
    echo "<tr><td>Class Name</td><td><input name='class_name' type='text' size='25' value='$row[class_name]'></td></tr>";
    echo "<tr><td>Start time</td><td><input name='start_time' type='time' size='25' value='$row[start_time]'></td></tr>";
    echo "<tr><td>End time</td><td><input name='end_time' type='time' size='25' value='$row[end_time]'></td></tr>";
    echo "<tr><td>Room number</td><td><input name='room_num' type='number' size='25' value='$row[room_num]'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text' size='25' value='$row[type]'></td></tr>";
    echo "<tr><td>Branch ID</td><td><input name='branch_id' type='number' size='25' value='$row[branch_id]'></td></tr>";
    echo "<tr><td>Instructor ID</td><td><input name='instructor_id' type='number' size='25' value='$row[instructor_id]'></td></tr>";
    
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editClasses_class_id"] = $class_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE classes SET start_time=:start_time, end_time=:end_time, room_num=:room_num, type=:type, 
                                branch_id=:branch_id, instructor_id=:instructor_id WHERE class_id=:class_id");
        
        $stmt->bindValue(':start_time', $_POST['start_time']);
        $stmt->bindValue(':end_time', $_POST['end_time']);
        $stmt->bindValue(':room_num', $_POST['room_num']);
        $stmt->bindValue(':type', $_POST['type']);
        $stmt->bindValue(':branch_id', $_POST['branch_id']);
        $stmt->bindValue(':instructor_id', $_POST['instructor_id']);
        
        $stmt->bindValue(':class_id', $_SESSION["editClasses_class_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editClasses_class_id"]);
    
    echo "Success";
}

?>