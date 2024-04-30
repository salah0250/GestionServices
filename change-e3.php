<?php
session_name("log");
session_start();
include "db_conn.php";
$email=$_SESSION['new_email'];
$id=$_SESSION['unique_id'];

    if (isset($_POST["verify_code"]))
    {
        $verification_code = $_POST["verification_code"];
        $sql = "SELECT *
                FROM users WHERE 
                unique_id='$id' AND verification_code='$verification_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
            $sql_2 = "UPDATE users
            SET email='$email', email_verified_at = NOW()
            WHERE unique_id='$id'";
            $_SESSION['email'] =$email;
  mysqli_query($conn, $sql_2);
  header("Location: profil.php?success=Your password has been changed successfully");
exit();
        }
        $error[]="Verification code failed";
       
        
    }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="assets/css/verification.css">
    <title>e-service</title>
</head>
<body>
<div class="container">
<form method="POST">
    <p>Saisissez le code de vérification reçu à l'adresse e-mail <?php echo $email;  ?> </p>
    <?php
                     if(isset($error)){
                         foreach($error as $error){
                             echo '<span class="error-msg" style=" margin: 10px;
                             display: block;
                             background: #586b28;
                             color: #fff;
                             border-radius: 5px;
                             font-size: 20px;
                             padding: 10px;
                             text-align: center;">'.$error.'</span>';
                         };
                     };

                     ?>
    <input type="text" name="verification_code" placeholder="Enter verification code" required />

    <input type="submit" name="verify_code" value="Verify Code">
	<br>
	<br>
	<a href='/new/index2.php'>back home</a>
</form></div></html>