<?php
session_name("log");
session_start();
include "db_conn.php";
if(isset($_SESSION["unique_id"])){
  $id=$_SESSION["unique_id"];
$query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='$id'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
}
    

$pdo = new PDO('mysql:host=localhost;dbname=test_db', 'root', '');

// Requête pour récupérer toutes les annonces
$sql = 'SELECT * FROM annonce';

// Vérifier si des filtres ont été sélectionnés
if (isset($_GET['ville']) && $_GET['ville'] !== '' && isset($_GET['categorie']) && $_GET['categorie'] !== '' && isset($_GET['search'])) {
    $ville = $_GET['ville'];
    $categorie = $_GET['categorie'];
    $search = $_GET['search'];

    $sql .= " WHERE ville = '$ville' AND categorie = '$categorie' AND titre LIKE '%$search%'";
}
// Vérifier si un tri a été sélectionné
if (isset($_GET['sort'])) {
  $sort = $_GET['sort'];
 if ($sort == 'date_creation ASC' || $sort == 'date_creation DESC') {
    $sql .= " ORDER BY date_creation ";
} else if ($sort == 'prix ASC' || $sort == 'prix DESC') {
    $sql .= " ORDER BY prix ";
}
  if (strpos($sort, 'DESC') !== false) {
      $sql .= "DESC";
  } else {
      $sql .= "ASC";
  }
}

// Exécution de la requête
$stmt = $pdo->query($sql);
$annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Recherche</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
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
              <li><a href="index2.php">Accueil</a></li>
              <li><a href="search.php" class="active">Recherche</a></li>
              <li><a href="contact.php">Help</a></li> 
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

  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top-text header-text">
            <h2>Trouver votre service &amp; specialiste </h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="search-form" name="gs" method="get" role="search" action="">
            <div class="row">
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <select name="categorie" id="categorie" class="form-select" aria-label="Area" id="chooseCategory" onchange="this.form.click()">
                          <option selected>Catégories</option>
                          <option value="Bricolage">Bricolage</option>
                          <option value="Ménage">Ménage</option>
                          <option value="Category 3">Jardinage</option>
                          <option value="Category 4">Garde d'enfants</option>
                          <option value="Category 5">Cours particulier</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <input type="address" name="search" class="searchText" placeholder="Entrer titre d'annonce" autocomplete="on" required>
                  </fieldset>
              </div>
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <select name="ville" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                          <option selected>Ville</option>
                          <option value="Nice">Nice</option>
                          <option value="Antibes">Antibes</option>
                          <option value="Cannes">Cannes</option>
                          <option value="Monaco">Monaco</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-3">                        
                  <fieldset>
                      <button class="main-button"><i class="fa fa-search"></i> Recherche</button>
                  </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-10 offset-lg-1">
          <ul class="categories">
            <li><a href="category.html"><span class="icon"><img src="assets/images/search-icon-01.png" alt="Bricolage"></span> Bricolage</a></li>
            <li><a href="listing.html"><span class="icon"><img src="assets/images/search-icon-02.png" alt="Ménage"></span> Ménage</a></li>
            <li><a href="#"><span class="icon"><img src="assets/images/search-icon-03.png" alt="Jardinage"></span> Jardinage</a></li>
            <li><a href="#"><span class="icon"><img src="assets/images/search-icon-04.png" alt="Garde d'enfants"></span> Garde d'enfants</a></li>
            <li><a href="#"><span class="icon"><img src="assets/images/search-icon-05.png" alt="Cours particulier"></span> Cours particulier</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Résultats</h2>
          </div>
        </div>
      
          <!-- <button class="col-lg-6" onclick="sortList()">Sort</button> -->
          <div class="col-lg-12">
            <div class="owl-cardousel">
              <div class="item">
                <div id="listContainer" class="row">
                  <div  class="col-lg-12 AnnonceItem">
                  <?php foreach ($annonces as $annonce): ?>
                    <div class="listing-item">
                    <div class="left-image">
                      <a href="annonce.php?id=<?= $annonce['id'] ?>"><img src="images/<?php echo $annonce['image']; ?>" alt="<?php echo $annonce['titre']; ?>" style="width:250px; height:"></a>
                    </div>
                      <div class="right-content align-self-center">
                        <a href="#"><h4><?php echo $annonce['titre']; ?></h4></a>
                        <h6>De : <?php echo $annonce['categorie']; ?></h6>
                       
                        <span class="price">
                          <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                          <span class="priceAnnonce"><?php echo $annonce['prix']; ?></span> €
                        </span>
                        <div class="main-white-button">
                          <a href="annonce.php?id=<?= $annonce['id'] ?>"><i class="fa fa-eye"></i> consulter</a>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
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
              <img src="assets/images/black-logo.png" alt="">
            </div>
            <p>Avec E-service vous pouvez offrir vos compétences et recevoir de l'aide en retour! Notre communauté est composée de personnes de différents horizons.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="helpful-links">
            <h4>Helpful Links</h4>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><a href="#">Accueil</a></li>
                  <li><a href="#">Categories</a></li>
                  <li><a href="#">Listing</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Useful Sites</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="contact-us">
            <h4>Contact Us</h4>
            <p>email@gmail.com</p>
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
  <script>
    function sortListByPrice() {
      var list, i, switching, b, shouldSwitch;
      list = document.getElementById("listContainer");
      var valueSelected=document.getElementById("filterSelected").value;
      switching = true;
      /* Make a loop that will continue until
      no switching has been done: */
        while (switching) { 
          // start by saying: no switching is done:
          switching = false;
          b = list.getElementsByClassName("AnnonceItem");
  
          // Loop through all list-items:
          for (i = 0; i < (b.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /* check if the next item should
            switch place with the current item: */
            k1=b[i].getElementsByClassName("priceAnnonce");
            k2=b[i+1].getElementsByClassName("priceAnnonce");
            var cmpr=false;
            if (valueSelected=="option1"){
              cmpr=k1[0].innerHTML.toLowerCase() > k2[0].innerHTML.toLowerCase();
            }
            else if(valueSelected=="option2"){
              cmpr=k1[0].innerHTML.toLowerCase() < k2[0].innerHTML.toLowerCase();
            }
            if (cmpr) {
              /* if next item is alphabetically
              lower than current item, mark as a switch
              and break the loop: */
              shouldSwitch = true;
              break;
            }
          }
         if (shouldSwitch) {
             /* If a switch has been marked, make the switch
            and mark the switch as done: */
            b[i].parentNode.insertBefore(b[i + 1], b[i]);
            switching = true;
          }
        }
      }
    </script>
    
</body>

</html>
