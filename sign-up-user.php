<?php 

    include_once 'connection.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $birthday = $_POST['birthday'];

    $sql = "INSERT INTO users(first_name, last_name, email, password, type, address, city, user_state, zip_code, birthday)
            VALUES('$first', '$last', '$email', '$pwd', '$type', '$address', '$city', '$state', '$zip', '$birthday');";
    
    $conn->query($sql);
   
    header("Location: index.php?signup = success");
?>