<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-classes.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Class name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Start Time</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>End Time</td><td><input name='email' type='text' size='25'></td></tr>";
    echo "<tr><td>Room Number</td><td><input name='password' type='number' size='25'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text' size='25'></td></tr>";    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";}
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO classes (class_name, start_time, end_time, room_num, type)
                                VALUES (:class_name, :start_time, :end_time, :room_num, :type)");

        $stmt->bindValue(':class_name', $_POST['class_name']);
        $stmt->bindValue(':start_time', $_POST['start_time']);
        $stmt->bindValue(':end_time', $_POST['end_time']);
        $stmt->bindValue(':room_num', $_POST['room_num']);
        $stmt->bindValue(':type', $_POST['type']);


        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>