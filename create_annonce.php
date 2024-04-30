<?php 
// Vérifier si l'utilisateur est connecté
session_name("log");
session_start();
// Connexion à la base de données
include "db_conn.php";
if(isset($_SESSION["unique_id"])){
    $id=$_SESSION["unique_id"];
  $query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$id'") or die(mysqli_error());
                  $fetch = mysqli_fetch_array($query);
  }
$a=$_SESSION["control"];
if(!$a){
	header("Location:signin.php");
}
  

  // Vérifier si le formulaire a été soumis
  if (isset($_POST['submit'])) {
    // Récupération des détails de l'annonce à partir du formulaire
    $title =mysqli_real_escape_string($conn, $_POST['titre']);
    $category = $_POST['categorie'];
     
    $description=mysqli_real_escape_string($conn, $_POST['description']);
    
    $image = $_FILES['image']['name'];
    $prix = $_POST['price'];
    $ville=mysqli_real_escape_string($conn, $_POST['ville']);
        // Enregistrer l'image dans un dossier
if (!empty($_FILES['image']['name'])) {
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES['image']['name']);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Vérifier le type de fichier
if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    exit;
}

// Vérifier si le fichier a été téléchargé avec succès
if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    // Succès
} else {
    echo "Une erreur est survenue lors de l'enregistrement de l'image.";
    exit;
}

$image = basename($_FILES['image']['name']);
}

    // Récupération de l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['unique_id'];

    // Insertion des détails de l'annonce dans la base de données
    $query = "INSERT INTO annonce (user_id, titre, categorie, description, image, prix, ville) VALUES ( '$user_id', '$title', '$category', '$description', '$image', '$prix' , '$ville')";
    if (mysqli_query($conn, $query)) {
      echo "L'annonce a été créée avec succès.";
      // Redirection vers la page de l'annonce créée
      header("Location: annonce.php?id=" . mysqli_insert_id($conn));
      exit;
    } else {
      echo "Une erreur est survenue lors de la création de l'annonce: " . mysqli_error($conn);
    }
  }
  // Fermeture de la connexion à la base de données
			mysqli_close($conn);
	?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Create annonce</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="static/css/chat.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/stylegeneral.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>

<body>

  <!-- * Preloader Start * -->
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
  <!-- * Preloader End * -->

  <!-- * Header Area Start * -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- * Logo Start * -->
            <a href="index2.php" class="logo">
            </a>
            <!-- * Logo End * -->
            <!-- * Menu Start * -->
            <ul class="nav">
              <li><a href="index2.php">Accueil</a></li>
              <li><a href="search.php">Recherche</a></li>
              <li><a href="contact.php">Aide</a></li>
              <?php 
              if(isset($_SESSION["control"])){
                if($_SESSION["control"]==true){
                  echo "<li><div class='main-white-button'><a href='profil.php'><img src='./profil/upload/".$fetch["photo"]."' class='img-thumbnail'
                  style='width: 35px'>profil de ".$fetch['name']."<a href=logout.php><i class='fa fa-sign-out'></i>Logout</a></div></li>";
                }
             
               /* echo "<a href=logout.php><i class='fa fa-sign-out'>Logout</a></i>";?></a></li>             
 */
              }else{
                echo "<li><div class='main-white-button'><a href='signin.php'><i class='fa fa-sign-in'></i> Se connecter</a></div></li>";

              }?>

            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- * Menu End * -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- * Header Area End * -->
  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>Create your annocne now</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-lg-12 align-self-center">
                <form id="contact" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">
                        <h4>Create an annonce</h4>
                        <br><br>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <input type="text" name="titre" id="titre" placeholder="titre" autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <textarea type="text" name="description" id="description" class="form-control"  placeholder="Message" required=""></textarea>  
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <select name="categorie" type="text" required >
                          <option value="">-- Sélectionner une catégorie --</option>
                          <option value="cours">Cours particuliers</option>
                          <option value="bricolage">Bricolage</option>
                          <option value="garde">Garde d'enfants</option>
                          <option value="jardinage">Jardinage</option>
                          <option value="menage">Ménage</option>
                          <option value="autre">Autre</option>
                        </select>  
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="number" name="price" id="price" placeholder="price" step=any autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" name="ville" placeholder="Ville" step=any autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="file" name="image" multiple>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" name="submit" class="main-button "><i class="fa fa-paper-plane"></i> Send Message</button>
                      </fieldset>
                    </div>
                  </div>
                </form>
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
  <script src="static/scripts/responses.js"></script>
  <script src="static/scripts/chat.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>
