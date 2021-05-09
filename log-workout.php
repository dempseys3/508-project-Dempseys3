<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    echo "<form method='post' action='log-workout.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    
    echo "<tr><td>Start Time HH:MM:SS</td><td><input name='start_time' type='text' size='25'></td></tr>";
    echo "<tr><td>End Time HH:MM:SS</td><td><input name='end_time' type='text' size='25'></td></tr>";
    echo "<tr><td>Type: Cardio/Strength/Restorative etc.</td><td><input name='type' type='text' size='25'></td></tr>";
    echo "<tr><td>6-Digit Member ID</td><td><input name='member_ID' type='number' size='25'></td></tr>";
    echo "<tr><td>6-Digit Branch ID</td><td><input name='branch_ID' type='number' size='25'></td></tr>";
    
    $stmt = $conn->prepare("SELECT branch_ID, CONCAT(street_address, ' ', city, ' ', branch_state, ' ', zip_code) AS 'Address' 
                            FROM branches");
    $stmt->execute();
    
    echo "<select name='branch_ID'>";
    
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[branch_ID]'> Branch:  $row[branch_ID]   Address: $row[Address]</option>";
    }
    
  
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";}
    else {
        
        try {
            $stmt = $conn->prepare("INSERT INTO workouts (start_time, end_time, type, member_ID, branch_ID)
                                VALUES (:start_time, :end_time, :type, :member_ID, :branch_ID)");
            
            $stmt->bindValue(':start_time', $_POST['start_time']);
            $stmt->bindValue(':end_time', $_POST['end_time']);
            $stmt->bindValue(':type', $_POST['type']);
            $stmt->bindValue(':member_ID', $_POST['member_ID']);
            $stmt->bindValue(':branch_ID', $_POST['branch_ID']);
            
            

            
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
        
        echo "Success";
    }
    ?>