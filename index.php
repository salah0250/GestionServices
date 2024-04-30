<?php 
include "db_conn.php";
$sql = "SELECT * FROM annonce ORDER BY date_creation DESC LIMIT 3";
$result = mysqli_query($conn, $sql);
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

    <title>e-service Accueil</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/stylegeneral.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.php" class="active">Accueil</a></li>
              <li><a href="search.php">Recherche</a></li>
              <li><a href="contact.php">Aide</a></li> 
              <li><div class="main-white-button"><a href="signin.php"><i class="fa fa-sign-in"></i> Se connecter</a></div></li> 
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

  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top-text header-text">
            <h2>Trouver votre service &amp; specialiste </h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="search-form" name="gs" method="submit" role="search" action="#">
            <div class="row">
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <select name="area" class="form-select" aria-label="Area" id="chooseCategory" onchange="this.form.click()">
                          <option selected>Catégories</option>
                          <option value="Category 1">Bricolage</option>
                          <option value="Category 2">Ménage</option>
                          <option value="Category 3">Jardinage</option>
                          <option value="Category 4">Garde d'enfants</option>
                          <option value="Category 5">Cours particulier</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <input type="address" name="address" class="searchText" placeholder="Entrer titre d'annonce" autocomplete="on" required>
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
                      <button class="main-button"><i class="fa fa-search"></i> Search Now</button>
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


  <div class="popular-categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Categories populaires</h2>
            <h6>Consultez-les</h6>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="grid">
              <div class="row">
                <div class="col-lg-3">
                  <div class="menu">
                    <div class="first-thumb active">
                      <div class="thumb">
                        <span class="icon"><img src="assets/images/search-icon-01.png" alt=""></span>
                        Bricolage
                      </div>
                    </div>
                    <div>
                      <div class="thumb">                 
                        <span class="icon"><img src="assets/images/search-icon-02.png" alt=""></span>
                        Ménage
                      </div>
                    </div>
                    <div>
                      <div class="thumb">                 
                        <span class="icon"><img src="assets/images/search-icon-03.png" alt=""></span>
                        Jardinage
                      </div>
                    </div>
                    <div>
                      <div class="thumb">                 
                        <span class="icon"><img src="assets/images/search-icon-04.png" alt=""></span>
                        Garde d'enfants
                      </div>
                    </div>
                    <div class="last-thumb">
                      <div class="thumb">                 
                        <span class="icon"><img src="assets/images/search-icon-05.png" alt=""></span>
                        Cours particulier
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="col-lg-9 align-self-center">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Un bricoleur expérimenté à votre service !</h4>
                                <p>Un univers passionnant qui regroupe toutes les activités manuelles et de réparation que l'on peut réaliser chez soi ou dans son propre espace de travail. Que vous soyez un débutant ou un bricoleur expérimenté, les projets de bricolage sont une source d'inspiration infinie pour construire, réparer, décorer et améliorer votre maison ou votre espace de travail.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Découvrir les annonces</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="assets/images/bricolage.jpg" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Service de ménage professionnel pour un foyer propre et confortable</h4>
                                <p>La catégorie ménage regroupe toutes les activités liées à l'entretien et au nettoyage de votre maison ou de votre appartement. Que vous soyez un amateur ou un expert en matière de ménage, cette catégorie est là pour vous aider à garder votre maison propre, organisée et agréable à vivre.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Découvrir les annonces</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="assets/images/ménage.jpg" alt="Foods on the table">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Un jardinage réussi et un espace extérieur magnifique</h4>
                                <p>La catégorie de jardinage concerne toutes les activités liées à la culture, à l'aménagement et à l'entretien des espaces verts. Cette catégorie propose des conseils et astuces pour créer et entretenir un jardin magnifique et productif, ainsi que pour améliorer l'esthétique et la fonctionnalité de votre espace extérieur.</p>
                                <div class="main-white-button"><a href="listing.html"><i class="fa fa-eye"></i> Découvrir les annonces</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="assets/images/jardinage.jpg" alt="cars in the city">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Garde d'enfants fiable et attentive pour vos petits trésors</h4>
                                <p>Que vous soyez parent, baby-sitter ou professionnel de la petite enfance, la catégorie de garde d'enfants est là pour vous aider à prendre soin de vos enfants de manière efficace et épanouissante.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Découvrir les annonces</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="assets/images/garde.jpg" alt="Shopping Girl">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Des cours particuliers sur mesure pour développer ses compétences</h4>
                                <p>Les cours particuliers propose des services d'enseignement individuel, personnalisé et adapté aux besoins de chaque apprenant. Cette catégorie s'adresse à tous les niveaux d'études, des élèves du primaire aux étudiants du supérieur, en passant par les adultes souhaitant développer de nouvelles compétences.</p>
                                <div class="main-white-button"><a rel="nofollow" href="#"><i class="fa fa-eye"></i> Découvrir les annonces</a></div>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>          
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Annonces récentes</h2>
            <h6>Check Them Out</h6>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-carousel owl-listing">
            <div class="item">
              <div class="row">
                <div class="col-lg-12">
                <?php 
                       // Boucle pour afficher chaque annonce
                       while ($row = mysqli_fetch_assoc($result)) {
                       ?>
                  <div class="listing-item">
                    <div class="left-image">
                      <a href="annonce.php?id=<?= $row['id'] ?>"><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['titre']; ?>" style="width:500px; height:"></a>
                    </div>
                    <div class="right-content align-self-center">
                      <a href="#"><h4><?php echo $row['titre']; ?></h4></a>
                      <h6><?php echo $row['description']; ?></h6>
      
                      <span class="price"><div class="icon"><img src="assets/images/listing-icon-01.png" alt=""><?php echo $row['prix']; ?>€</div></span>
                      <div class="main-white-button">
                        <a href="annonce.php?id=<?= $row['id'] ?>"><i class="fa fa-eye"></i> Consulter</a>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                     ?>
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
                  <li><a href="index.php">Accueil</a></li>
                  <li><a href="search.html">Recherche</a></li>
                  <li><a href="contact.html">Aide</a></li>
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
