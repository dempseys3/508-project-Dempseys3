<?php
    require_once ('connection.php');
    
    $id = "";
    $first = "";
    $last = "";
    $email = "";
    $pwd = "";
    $type = "";
    $address = "";
    $city = "";
    $state = "";
    $zip = "";
    $birthday = "";
    
    function getPosts(){
        $posts = array();
        
        $posts[0] = $_POST['id'];
        $posts[1] = $_POST['first'];
        $posts[2] = $_POST['last'];
        $posts[3] = $_POST['email'];
        $posts[4] = $_POST['pwd'];
        $posts[5] = $_POST['type'];
        $posts[6] = $_POST['address'];
        $posts[7] = $_POST['city'];
        $posts[8] = $_POST['state'];
        $posts[9] = $_POST['zip'];
        $posts[10] = $_POST['birthday']; 
        
        return $posts;
    }
    
    //Search
    if(isset($_POST['search'])){
        
        $data = getPosts();
        
        $search_query= "SELECT * FROM users WHERE user_ID = $data[0];";
        
        $search_result = $conn->query($search_query);
                
           if($search_result->rowCount() > 0){
               
               while($row = $search_result->fetchAll(PDO::FETCH_ASSOC)){
                   
                   $id = $data[0];
                   $first = $data[1];
                   $last = $data[2];
                   $email = $data[3];
                   $pwd = $data[4];
                   $type = $data[5];
                   $address = $data[6];
                   $city = $data[7];
                   $state = $data[8];
                   $zip = $data[9];
                   $birthday = $data[10];
               }
           }
           else{
               echo 'No data under this ID';
           }
       }
    
    //DELETE 
    if(isset($_POST['delete'])){
        $data = getPosts();
        $delete_query = "DELETE FROM users WHERE user_id = $data[0]";
        
        try{
            $delete_result = $conn->query($delete_query);
            
                if($delete_result->rowCount() > 0){
                    
                    echo 'Data deleted';
                }
                else{
                    echo 'Data not deleted';
                }
           
        }
        catch(Exception $ex){
            echo 'Error delete '.$ex->getMessage();
        }
    }
    
    //UPDATE
    if(isset($_POST['update'])){
        
        $data = getPosts();
        
        $update_query= "UPDATE users SET first_name = $data[1], last_name = $data[2], email = $data[3],
                        pwd = $data[4], type = $data[5], address = $data[6], city = $data[7], user_state = $data[8],
                        zip_code = $data[9], birthday = $data[10] WHERE user_id = $data[0];";
        
        try{
            
        $update_result = $conn->query($update_query);
            
            if($update_result->rowCount() > 0){
                
                echo 'Data updated';
            }
            else{
                echo 'Data not updated';
            }
    }
    catch(Exception $ex){
            echo 'Error update '.$ex->getMessage();
    }
}
?>

<html>
<head>
<body>

<title>Update Information</title>
	
	<form action="delete.php" method ="post">
	
		<input type = 'number' name = "id" placeholder = "6-digit user ID" value = "<?php echo $id;?>">
		<br>
		<br>
		<input type = 'text' name = "first" placeholder = "First Name" value = "<?php echo $first;?>">
		<br>
		<br>
		<input type = 'text' name = "last" placeholder = "Last Name" value = "<?php echo $last;?>">
		<br>
		<br>
		<input type = 'text' name = "email" placeholder = "E-mail" value = "<?php echo $email;?>" >
		<br>
		<br>
		<input type = 'password' name = "pwd" placeholder = "Password" value = "<?php echo $pwd;?>">
		<br>
		<br>
		<input type = 'text' name = "type" placeholder = "Type" value = "<?php echo $type;?>">
		<br>
		<br>
		<input type = 'text' name = "address" placeholder ="Address" value = "<?php echo $address;?>">
		<br>
		<br>
		<input type = 'text' name = "city" placeholder = "City" value = "<?php echo $city;?>">
		<br>
		<br>
		<input type = 'text' name = "state" placeholder = "State" value = "<?php echo $state;?>">
		<br>
		<br>
		<input type = 'text' name = "zip" placeholder = "Zip-Code" value = "<?php echo $zip;?>" >
		<br>
		<br>
		<input type = 'text' name = "birthday" placeholder = "Birthday yyyy-mm-dd" value = "<?php echo $birthday;?>">
		<div>
			<input type = "submit" name = "update" value = "Update">
			<input type = "submit" name = "delete" value = "Delete">
			<input type = "submit" name = "search" value = "Search"
		</div>
</form>
</body>
</head>
</html>