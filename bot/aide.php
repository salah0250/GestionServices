<?php
session_name("log");
session_start();
include "../db_conn.php";
if(isset($_SESSION["id"])){
  $id=$_SESSION["id"];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Helpp</title>
    <link rel="stylesheet" href="static/css/chat.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="static/css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>
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
              <li><a href="search.html">Recherche</a></li>
              <li><a href="contact.html" class="active">Aide</a></li> 
              <?php 
              if(isset($_SESSION["control"])){
                if($_SESSION["control"]==true){
                  echo "<li><div class='main-white-button'><a href='profil.php'><img src='./profil/upload/".$fetch["photo"]."' class='img-thumbnail'
                  style='width: 35px'>Profil de ".$fetch['name']."</a><a href=logout.php><i class='fa fa-sign-out'>Logout</a></i></div></li>";
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
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  

    <div class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="top-text header-text">
              <h6>Keep in touch with us</h6>
              <h2>Feel free to send us a message about your business needs</h2>
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
                <div class="col-lg-6">
                  <div id="map">
                    <iframe src="https://maps.google.com/maps?q=28+Av.+Valrose,+06000+Nice&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
                  </div>
                </div>
                <div class="col-lg-6 align-self-center">
                  <form id="contact" action="" method="get">
                    <div class="row">
                      <div class="col-lg-6">
                        <fieldset>
                          <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                        </fieldset>
                      </div>
                      <div class="col-lg-6">
                        <fieldset>
                          <input type="surname" name="surname" id="surname" placeholder="Surname" autocomplete="on" required>
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <select required>
                          <option value="">-- Sélectionner une catégorie --</option>
                          <option value="services">Cours particuliers</option>
                          <option value="bricolage">Bricolage</option>
                          <option value="garde-d'enfants">Garde d'enfants</option>
                          <option value="jardinage">Jardinage</option>
                          <option value="autre">Autre</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-button "><i class="fa fa-paper-plane"></i> Send Message</button>
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
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">Assistant E-Service
            <i id="chat-icon" style="color: #fff;" class="fa fa-fw fa-comments-o"></i>
        </button>

        <div class="content">
            <div class="full-chat-block">
                <div class="outer-container">
                    <div class="chat-container">
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                        </div>

                        
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Entrez votre question">
                                <p></p>
                            </div>

                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"
                                    onclick="sendButton()"></i>
                            </div>
                        </div>

                        <div id="chat-bar-bottom">
                            <p></p>
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
                    <li><a href="index.html">Accueil</a></li>
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/responses.js"></script>
<script src="static/scripts/chat.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>


</html>