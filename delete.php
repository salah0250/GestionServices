<?php
session_name("log");
session_start();
include "db_conn.php";

$id=$_SESSION["unique_id"];
$email =$_SESSION['email'];
    if (isset($_POST["delete"]))
    {
        $sql = "DELETE FROM users WHERE unique_id='".$id."'";

			mysqli_query($conn, $sql);

            header("Location: signin.php?success=deleted");
			 
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Supprimer le compte</title>
    <link rel="stylesheet" href="assets/css/recmdp.css">
</head>
<body>
    <div class="container">
<form method="POST" action="delete.php" >
        <h1>Supprimer votre E-compte</h1>
<p><?php echo $_SESSION['name']; ?>, Vous êtes sur le point de supprimer votre compte. Cette action est irréversible. </p>

    <input type="submit" name="delete" value="Supprimer">
	
	<a href='index2.php'>Retour à la page d'accueil</a>
</form>
    
    </div>
</body>
</html>

