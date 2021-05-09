<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='make-payment.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Dollar Amount</td><td><input name='dollar_amount' type='decimal' size='25'></td></tr>";
    echo "<tr><td>Payment Time hh:mm:ss </td><td><input name='payment_time' type='text' size='25'></td></tr>";

    
    echo "</select>";
    echo "</td></tr>";
    
    
    $stmt = $conn->prepare("SELECT member_id, CONCAT(u.first_name, ' ', u.last_name) AS 'Name'
                            FROM users u JOIN members m ON m.member_id = u.user_id");
    $stmt->execute();
    
    echo "<select name='member_ID'>";
    
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[member_ID]'> User:  $row[Name]</option>";
    }
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";} 
else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO payments(dollar_amount, payment_time)
                                VALUES (:dollar_amount, :payment_time)");

        $stmt->bindValue(':dollar_amount', $_POST['dollar_amount']);
        $stmt->bindValue(':payment_time', $_POST['payment_time']);


        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";  
}
?>