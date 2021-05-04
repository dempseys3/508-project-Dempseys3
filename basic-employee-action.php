<?php
require_once ('connection.php');

class User
{
    public function listUsers()
    {
        global $conn;
        
        $sqlQuery = "SELECT user_id as `ID`,
                     concat(first_name, ' ', last_name) as `name`,
                     email as 'email',
                     type as 'type',
                     address as'address'
                     FROM users ";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        
        $numberRows = $stmt->rowCount();
        
        $dataTable = array();
        
        while ($sqlRow = $stmt->fetch()) {
            $dataRow = array();
            
            $dataRow[] = $sqlRow['ID'];
            $dataRow[] = $sqlRow['name'];
            $dataRow[] = $sqlRow['email'];
            $dataRow[] = $sqlRow['type'];
            $dataRow[] = $sqlRow['address'];
            
            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }
}

$employee = new User();

if(!empty($_POST['action']) && $_POST['action'] == 'listUsers') {
    $employee->listUsers();
}

?>