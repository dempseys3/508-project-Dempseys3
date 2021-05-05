<?php 

    include_once 'connection.php';

    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $type = $_POST['type'];

    $sql = "INSERT INTO workouts(start_time, end_time, type)
            VALUES('$start_time', '$end_time', '$type');";
    
    $conn->query($sql);
   
    header("Location: index.php?signup = success");
?>