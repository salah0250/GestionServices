<?php
session_name("log");
session_start();
include "db_conn.php";

    if (isset($_POST["verify_email"]))
    {
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];

        // connect with database
        //$conn = mysqli_connect('localhost','root','','prova');

        // mark email as verified
        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $result  = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 0)
        {
            $error[]="Verification code failed.";
        }else{
            $error[]="Vous avez verifie votre email maintenant vous pouvez faire login <a href='/ser/signin.php?success=verified'>ici</a>";
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verification de compte</title>
    <link rel="stylesheet" href="assets/css/verification.css">
</head>
<body>
    <div class="container">
        <h1>Verification de compte</h1>
        <p>Pour continuer dans E-Service, entrez le code de vérification envoyé à votre adresse e-mail <?php echo $_SESSION['emailv']; ?> :</p>
        <form id="verificationForm" method="POST">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
    <input type="text" name="verification_code" placeholder="Enter verification code" required />

    <input type="submit" name="verify_email" value="Verify Email">
	<br>
	<br>
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
	<a href='signin.php'>back home</a>
    </div>
    <script src="script.js"></script>
</body>
</html>
