<?php 
session_name("log");
session_start();
include "db_conn.php";
if(isset($_SESSION["unique_id"])){
  $id=$_SESSION["unique_id"];
$query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$id'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
}
    
// Récupérer l'ID de l'annonce à partir de l'URL
$id = $_GET['user_id'];
$pdo = new PDO('mysql:host=localhost;dbname=test_db', 'root', '');

// Requête pour récupérer les détails de l'utilisateur
$sql3 = "SELECT * FROM users WHERE unique_id = :user_id";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute(['user_id' => $id]);
$user = $stmt3->fetch(PDO::FETCH_ASSOC);

// Récupérer les 4 dernières annonces
$sql = "SELECT * FROM annonce WHERE user_id = $id ORDER BY date_creation DESC LIMIT 4";
$result = mysqli_query($conn, $sql);


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
    <style>
    .annonce-card {
      background-color: #f5f5f5;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 2px rgba(0,0,0,0.1);
  margin-bottom: 20px;
  overflow: hidden;
  position: relative;
  text-align: center;
  }
  .annonce-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  .annonce-card h3 {
    color :white;
    font-size: 24px;
  font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>
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
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
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
              <li><a href="index2.php" class="active">Accueil</a></li>
              <li><a href="search.php">Recherche</a></li>
              <li><a href="contact.php">Aide</a></li> 
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
                        <img <?php echo "src=\"./profil/upload/{$user['photo']}\" "?>
                          style=" width: 100%; height: 200px;  margin-bottom: 10px; object-fit: cover;">
                      </div>
                      <div class="ms-3" style="margin-top: 130px;">
                        <h5><?php  echo $user['lname']?></h5>
                        <p style="color:#bbbbbb"><?php  echo $user['ville']?></p>
                      </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                      <div class="d-flex justify-content-end text-center py-1">
                        <div>
                          
                        </div>
                        <div class="px-3">
                          
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-4 text-black">
                      <div class="mb-5">
                        <p class="lead fw-normal mb-1">About</p>
                        <div class="p-4" style="background-color: #f8f9fa;">
                          <p class="font-italic mb-1"><?php  echo $user['description']?></p>
              
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="lead fw-normal mb-0">Recent Annonces</p>
                        <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                      </div>
                      
                      <div class="row g-2">
                        <section class="recent-annonces">
  <div class="container">
    <div class="row">
      <?php 
      // Boucle pour afficher chaque annonce
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-6 mb-4">
          <div class="annonce-card">
          <a href="annonce.php?id=<?= $row['id'] ?>">  
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['titre']; ?>"class="w-100 rounded-3 imgArticle">
            <h3><?php echo $row['categorie']; ?></h3>
          </a>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>

                        

                    
                    </div>

                    <!-- Popup edit profile -->
                    <div id="my-popup" class="popup">
                      <div>
                        <form class="popup-content">
                          <a href="#" id="close-popup">&times;</a>
                          <div class="profile-pic">
                            <label class="-label" for="file">
                              <span class="fa fa-camera"></span>
                              <span>Change Image</span>
                            </label>
                            <input id="file" type="file" onchange="loadFile(event)" />
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" id="output" width="200" />
                          </div>

                          <label for="firstName">First name :</label>
                          <input type="text" id="firstName" name="firstName" value="Jean" placeholder="Your first name ..." required>
                          
                          <label for="lastName">Last name:</label>
                          <input type="text" id="lastName" name="lastName" value="whick" placeholder="Your last name ..." required>
                          
                          <label for="message">About:</label>
                          <textarea id="message" name="message" value="Web Developer \n Lives in New York \n Photographer" placeholder="Small description about you ..." required></textarea>
                          
                          <button type="submit">Save</button>
                        </form>
                      </div>
                    </div>
                  <!-- Popup edit profile end  -->

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
