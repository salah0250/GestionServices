<?php 
session_name("log");

session_start();

if (isset($_SESSION['unique_id'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="assets/css/verification.css">
    <title>e-service</title>
</head>
<body>
<div class="container">
<h1>Changer le mot de passe</h1>
    <form action="change-p.php" method="post">
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
		<label for="current-password">Mot de passe actuel:</label>
            <input type="password" name="op" 
     	       placeholder="Old Password" required>
				<br>
            <label for="new-password">Nouveau mot de passe:</label>
            <input type="password" name="np" 
     	       placeholder="New Password" required>
			    <br>
				<label>Confirm New Password</label>
			<input type="password" 
     	       name="c_np" 
     	       placeholder="Confirm New Password" required>
				<br>
            <button type="submit">Changer</button>
			
          <a href="profil.php" class="ca">HOME</a>
     	
     </form>
	 </div>
</body>
</html>

<?php 
}else{
     header("Location: index.html");
     exit();
}
 ?>