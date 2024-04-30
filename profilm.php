<?php
session_name("log");
session_start();
$a=$_SESSION["control"];
		$id=$_SESSION["unique_id"];
    include "db_conn.php";


if(!$a){
	header("Location:signin.php");
}
//$conn = mysqli_connect('localhost','root','','prova');
$email=$_SESSION["emmm"];
	$query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$id'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
				
				//echo "profil de ".$fetch['id'];
 /*
				echo "<h2 class='text-success'>".$fetch['name']."</h2>";
	echo "<a href=logout.php><button>Logout</button>";*/
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>E-Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--



-->
  </head>

<body>

<form class="shadow w-450 p-3" 
              action="prova.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" required 
                   class="form-control"
                   name="fname"
                   value="<?php echo $fetch['name']?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Prenom</label>
            <input type="text" required
                   class="form-control"
                   name="lname"
                   value="<?php echo $fetch['lname']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">User mail</label>
            <input type="mail" disabled
                   class="form-control"
                   name="uname"
                   value="<?php echo $fetch['email']?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input type="tel" required
                   class="form-control"
                   name="tel"
                   value="<?php echo $fetch['telephone']?>">
          </div>
          <div class="mb-3">
            <label class="form-label">User description</label>
            <input type="text" required
                   class="form-control"
                   name="desc"
                   value="<?php echo $fetch['description']?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" required
                   class="form-control"
                   name="ville"
                   value="<?php echo $fetch['ville']?>">
          </div>
          <div class="mb-3">
            <label class="form-label"><a href="change-email.php">Change Email</a></label>
          </div>
          <div class="mb-3">
            <label class="form-label"><a href="change-password.php">Change Password</a></label>
          </div>
          <div class="mb-3">
            <label class="form-label"><a href="delete.php">Supprimer compte</a></label>
          </div>
          
          <br>
          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" 
                   class="form-control"
                   name="pp">
            <img src="./profil/upload/<?=$fetch['photo']?>"
            class="img-fluid img-thumbnail mt-4 mb-2"
                          style="width: 120px; z-index: 1">
            <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$fetch['photo']?>" >
          </div>
          <br>
          <button type="submit" name="envoyer" class="btn btn-primary">Update</button>
          <a href="index2.php" class="link-secondary">Home</a>
        </form>
    </div>
  



</body>

</html>
