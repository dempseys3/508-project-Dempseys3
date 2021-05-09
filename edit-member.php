<html>
<head>
<title>Alpha Athletics</title>
</head>
</html>
<?php

require_once('connection.php');

if (!isset($_GET['member_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT member_id, CONCAT(first_name,' ', last_name) AS 'Name'
                            FROM members e JOIN users u ON u.user_id = e.member_id 
                            ORDER BY member_id");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='member_id' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[member_id]'>$row[member_id] $row[Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $member_id = $_GET["member_id"];
    
    $stmt = $conn->prepare("SELECT member_id, CONCAT(first_name,' ', last_name) AS 'Name', height, weight
                            FROM members e JOIN users u ON member_id = user_id WHERE member_id=:member_id");
    $stmt->bindValue(':member_id', $member_id);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='edit-member.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Member ID</td><td><input name='member_id' type='number' size='25' value='$row[member_id]'></td></tr>";
    echo "<tr><td>Member Name</td><td><input name='Name' type='text' size='25' value='$row[Name]'></td></tr>";
    echo "<tr><td>Height</td><td><input name='height' type='text' size='25' value='$row[height]'></td></tr>";
    echo "<tr><td>Weight</td><td><input name='weight' type='text' size='25' value='$row[weight]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editMember_member_id"] = $member_id;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE members SET height=:height, weight=:weight WHERE member_id=:member_id");
        
        $stmt->bindValue(':height', $_POST['height']);
        $stmt->bindValue(':weight', $_POST['weight']);
        
        $stmt->bindValue(':member_id', $_SESSION["editMember_member_id"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editMember_member_id"]);
    
    echo "Success";
}

?>