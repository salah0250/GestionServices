



<?php
session_name("log");
session_start();
include "db_conn.php";

    if (isset($_POST["verify_code"]))
    {
        $oe = $_POST['verification_code'];
        
        
        $oe = md5($oe);
        $id = $_SESSION['unique_id'];
        $sql = "SELECT password
                FROM users WHERE 
                unique_id='$id' AND verification_email='$oe'";
				
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	header("Location: change-e2.php?success=OKKK");
		  exit();

        }else {
			$error[]="verification code failed";
        	
	       
        }

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
<h1>Vérification de votre e-mail actuel</h1>
<form method="POST">
    <p>Saisissez le code de vérification reçu à l'adresse e-mail <?php echo $_SESSION['email']; ?> </p>
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
	<a href='index2.php'>back home</a>
</form>
</body>
</html>

