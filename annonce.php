<?php
session_name("log");
session_start();
include "db_conn.php";
if(isset($_SESSION["unique_id"])){
    $user_id=$_SESSION["unique_id"];
  $query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$user_id'") or die(mysqli_error());
                  $fetch = mysqli_fetch_array($query);
  }


// Récupérer l'ID de l'annonce à partir de l'URL
$id = $_GET['id'];
$pdo = new PDO('mysql:host=localhost;dbname=test_db', 'root', '');
// Requête pour récupérer les détails de l'annonce

$sql = "SELECT * FROM annonce WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$annonce = $stmt->fetch(PDO::FETCH_ASSOC);




// Requête pour récupérer l'ID de l'utilisateur
$sql2 = "SELECT user_id FROM annonce WHERE id = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(['id' => $id]);
$user_id = $stmt2->fetch(PDO::FETCH_ASSOC)['user_id'];

// Requête pour récupérer les détails de l'utilisateur
$sql3 = "SELECT * FROM users WHERE unique_id = :user_id";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute(['user_id' => $user_id]);
$user = $stmt3->fetch(PDO::FETCH_ASSOC);


 
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

    <title>page annonce</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/stylegeneral.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>

<body>

  <!-- ** Preloader Start ** -->
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
  <!-- ** Preloader End ** -->

  <!-- ** Header Area Start ** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s" >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ** Logo Start ** -->
            <a href="index2.php" class="logo">
            </a>
            <!-- ** Logo End ** -->
            <!-- ** Menu Start ** -->
            <ul class="nav">
              <li><a href="index2.php">Accueil</a></li>
              <li><a href="search.php">Recherche</a></li>
              <li><a href="contact.php" >Aide</a></li> 
              <?php 
              if(isset($_SESSION["control"])){
                if($_SESSION["control"]==true){
                  echo "<li><div class='main-white-button'><a href='profil.php'><img src='./profil/upload/".$fetch["photo"]."' class='img-thumbnail'
                  style='width: 35px'>profil de ".$fetch['name']."<a href=logout.php><i class='fa fa-sign-out'></i>Logout</a></div></li>";
                }
              }else{
                echo "<li><div class='main-white-button'><a href='signin.php'><i class='fa fa-sign-in'></i> Se connecter</a></div></li>";

              }?>
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ** Menu End ** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ** Header Area End ** -->
  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>Catégorie :</h6>
            <h2>Bricolage</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="contact-page">
    <div class="container">
      <div class="row">
      <div>
      <img src="images/<?= $annonce['image'] ?>"  width="200px" height="400px"/>

      </div>
        <div class="col-lg-12">
          <div class="inner-content">
            <div class="row">                
                <div class="fixContainer">
                  
                  <div class="row">
                 

                    <div class="col-lg-3 align-self-left">

                      <div class="price-box">
                        <span class="price-value"><?php echo $annonce['prix'] ?> €</span>
                      </div>
                      <br><br>                   
                      <div class="rating-bottom">
                        <br>
                        <div>
                          <a href="Profile.php?user_id=<?php echo $annonce['user_id']; ?>">
                            <p><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $user['lname'] ?></p>
                          </a>
                          <p><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo $annonce['date_creation'] ?></p>
                          <p><i class="fa fa-tag"></i>&nbsp;&nbsp;<?php echo $annonce['categorie'] ?></p>
                          <p><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $annonce['ville'] ?></p>
                        </div>
                        <br> 
                      </div>
                      <div>
                        <a href="chat.html?user=Name" >
                          <br>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-9 align-self-center">
                        <h4><?php echo $annonce['titre'] ?></h4>
                        
                        <br>
                        <p><?php echo $annonce['description'] ?></p>
                        <br>
                        <a href="chat.php?user_id=<?php echo $annonce['user_id']; ?>" >
                          <button href="chat.php?user_id=<?php echo $annonce['user_id']; ?>"><i class="fa fa-paper-plane"></i> Contacter</button>
                        </a>
              </div>
            </div>
          </div>
        </div>
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

</body>

</html>
