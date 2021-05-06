<?php 

    include_once 'connection.php';

    $id = $_POST['id'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $class = $_POST['class'];

    $sql = "INSERT INTO class_signup(user_id, first_name, last_name, email, class_name)
            VALUES('$id', '$first', '$last', '$email', '$class');";
    
    $conn->query($sql);
   
    header("Location: class-signup.php?signup = success");
?>