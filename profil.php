<?php
session_name("log");
session_start();
$a=$_SESSION["control"];

include "db_conn.php";

$id=$_SESSION['unique_id']; 
if(!$a){
	header("Location:signin.php");
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$id'") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet">

    <title>Profile page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/stylegeneral.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/style.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index2.php" class="logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index2.php">Accueil</a></li>
              <li><a href="search.php">Recherche</a></li>
              <li><a href="contact.php">Aide</a></li> 
              <li><div class="main-white-button"><a href="profil.php"><img src="./profil/upload/<?=$fetch['photo']?>"
                 class="img-thumbnail"
                 style="width: 35px"> <?php echo "profil de ".$fetch['name']; echo "<a href=logout.php><i class='fa fa-sign-out'></i>";?> Logout</a></li>    
            </ul>     
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** --> 
    <div class="popular-categories">
      <div class="container">
        <div class="row">
          
          <section class="h-100 profileText">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                  <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #453856; height:200px;">
                      <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                      <img src="./profil/upload/<?=$fetch['photo']?>"
                          alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                          style="width: 120px; z-index: 1">
                          <form action="profilm.php">
         <button type="submit" id="openBtn" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                          style="z-index: 1;">Modifier</button>
      </form>
                        
                      </div>    
                      <div class="ms-3" style="margin-top: 130px;">
                        <h5 style="color:#bbbbbb"><?php echo $fetch['name']?></h5>
                        <p style="color:#bbbbbb"><?php echo $fetch['ville']?>, FR</p>
                      </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                      <div class="d-flex justify-content-end text-center py-1">
                        
                      </div>
                    </div>
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
                    <div class="card-body p-4 text-black">
                      <div class="mb-5">
                        <p class="lead fw-normal mb-1">About</p>
                        <div class="p-4" style="background-color: #f8f9fa;">
                          <p class="font-italic mb-1">Nom : <?php echo $fetch['name']?></p>
                          <p class="font-italic mb-1">Prenom : <?php echo $fetch['lname']?></p>
                          <p class="font-italic mb-1">Lives <?php echo $fetch['ville']?></p>
                          <p class="font-italic mb-1">Description <?php echo $fetch['description']?></p>
                        </div>
                      </div>
                      

                    
                  </div>
                </div>
              </div>
            </div>
          </section>
          
        </div>
      </div>
    </div>

      <footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="about">
                <div class="logo">
                  <img src="assets/images/black-logo.png" alt="e-service">
                </div>
                <p></p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="helpful-links">
                <h4>Liens Utils</h4>
                <div class="row">
                  <div class="col-lg-6">
                    <ul>
                      <li><a href="index2.php">Accueil</a></li>
                      <li><a href="search.php">Recherche</a></li>
                      <li><a href="contact.php">Aide</a></li>
                    </ul>
                  </div>
                  <div class="col-lg-6">
                    <ul>
                      <li><a href="#">Apropos nous</a></li>
                      <li><a href="#">Politique de confidentialité</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="contact-us">
                <h4>Contactez-nous</h4>
                <p>Valrose Nice</p>
                <div class="row">
                  <div class="col-lg-6">
                    <a href="#">010-020-0340</a>
                  </div>
                  <div class="col-lg-6">
                    <a href="#">090-080-0760</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
            <br>
            <br>
            </div>
          </div>
        </div>
      </footer>

      <!-- Scripts -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/owl-carousel.js"></script>
      <script src="assets/js/animation.js"></script>
      <script src="assets/js/imagesloaded.js"></script>
      <script src="assets/js/custom.js"></script>
      <!-- <script src="assets/js/logsign.js"></script> -->

    </body>

  </html>
