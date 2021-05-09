<html>
<head>
<title>Alpha Athletics</title>
<?php

require_once('connection.php');

if (!isset($_GET['schedule_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT schedule_id, start_date, end_date FROM schedules ORDER BY schedule_id");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='schedule_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[schedule_id]'>$row[start_date] $row[end_date]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $schedule_id = $_GET["schedule_id"];
    
    $stmt = $conn->prepare("SELECT schedule_id, start_date, end_date FROM schedules WHERE schedule_id=:schedule_id");
    $stmt->bindValue(':schedule_id', $schedule_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-schedules.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Schedule ID</td><td><input name='schedule_id' type='number' size='25' value='$row[schedule_id]'></td></tr>";
    echo "<tr><td>Start Date</td><td><input name='start_date' type='date' size='25' value='$row[start_date]'></td></tr>";
    echo "<tr><td>End Date</td><td><input name='end_date' type='date' size='25' value='$row[end_date]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editSchedule_schedule_id"] = $schedule_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE schedules SET start_date=:start_date, end_date=:end_date WHERE schedule_id=:schedule_id");
        
        $stmt->bindValue(':start_date', $_POST['start_date']);
        $stmt->bindValue(':end_date', $_POST['end_date']);

        $stmt->bindValue(':schedule_id', $_SESSION["editSchedule_schedule_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editSchedule_schedule_id"]);
    
    echo "Success";
}

?>