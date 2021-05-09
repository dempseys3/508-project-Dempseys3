<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='add-schedule.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Start Date</td><td><input name='start_date' type='date' size='25'></td></tr>";
    echo "<tr><td>End Date</td><td><input name='end_date' type='date' size='25'></td></tr>";

    
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO schedules(start_date, end_date)
                                VALUES (:start_date, :end_date)");

        $stmt->bindValue(':start_date', $_POST['start_date']);
        $stmt->bindValue(':end_date', $_POST['end_date']);


        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>
