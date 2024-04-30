<?php
session_name("log");
session_start();
include "db_conn.php";
$user_id=$_SESSION["unique_id"];
$_SESSION["control"]=false;
$_SESSION = array(); //pour efacer tout le variables de sesion
$sql_2 = "UPDATE users
        	          SET status='offline'
        	          WHERE unique_id='$user_id'";
        	mysqli_query($conn, $sql_2);
if (isset($_COOKIE[session_name()])) { //ca pour cookie
	setcookie(session_name(), '', time()-42000, '/');
} 
session_destroy(); //detruir session

header("Location:signin.php"); ///on revient au index
return; //pour securite
?>
