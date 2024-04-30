<?php 
session_name("log");
session_start();
include "db_conn.php";
if (isset($_SESSION['unique_id'])) {

   

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if($np !== $c_np){
      header("Location: change-password.php?error=Mot de passe different");
	  exit();
    }else {
    	$op = md5($op);
    	$np = md5($np);
        $id = $_SESSION['unique_id'];
        
        $sql = "SELECT password
                FROM users WHERE 
                unique_id='$id' AND password='$op'";
				
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE users
        	          SET password='$np'
        	          WHERE unique_id='$id'";
        	mysqli_query($conn, $sql_2);
        	header("Location: change-password.php?success=Mot de passe changé avec succes");
		  exit();

        }else {
        	header("Location: change-password.php?error=Mot de passe incorrect");
	        exit();
        }

    }

    
}else{
	header("Location: change-password.php");
	exit();
}

}else{
     header("Location: index.html");
     exit();
}