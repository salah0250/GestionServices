<?php
session_name("log");
session_start();
include "db_conn.php";
    
    if (isset($_POST["submit"]))
    {
       // $email = $_POST["email"];
        //$password = $_POST["password"];
        $email =$_POST['email'];
	$password = $_POST['password'];
		$_SESSION["emmm"]=$email;
        // connect with database
        //$conn = mysqli_connect('localhost','root','','prova');
        if (empty($email)) {
          $error[]='inserer mail!';
      
        }
        else if (empty($password)) {
          $error[]='inserer mdp!';
        }else{
	$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
        $pass = md5($password);

        // check if credentials are okay, and email is verified
        //$sql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1)
        {
          $row = mysqli_fetch_assoc($result);
          if($row['email_verified_at']=== NULL){
            die("Please verify your email <a href='verification.php?email=" . $email . "'>from here</a>");
          }
          if ($row['email'] === $email && $row['password'] === $pass) {
            $_SESSION["control"]=true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['unique_id'] = $row['unique_id'];
            $id=$_SESSION['unique_id'];
            $sql_2 = "UPDATE users
        	          SET status='online'
        	          WHERE unique_id='$id '";
        	mysqli_query($conn, $sql_2);
            $_SESSION['user_id'] = $row['user_id'];

            header("Location: index2.php");
          exit();
          }
        }else{
          $error[]='error email ou mdp!';

        }

      }
		
    }
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

    <title>Signin</title>

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
              <li><div class="main-white-button"><a href="#"><i class="fa fa-sign-in"></i> Se connecter</a></div></li> 
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
          <div class="containerBis" id="containerBis">
            <div class="form-containerBis sign-in-containerBis">
             <form action="#" method="post">
                <br><br><br><br>
                <h1>Sign In</h1>

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
                <span>Login to your account</span>
                <input type="email" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password"/>
                <br />
                <a href="resetp.php">Forgot your password?</a>
                <input type="submit" name="submit" placeholder="Login">

              </form>
            </div>
            <div class="overlay-containerBis">
              <div class="overlay">
                <div class="overlay-pannel overlay-right">
                  <h1>Create your Account</h1>
                  <p>Enter your personal detail and start journey with us</p>
                  <a href="signup.php">
                    <button class="ghost">Sign Up</button>
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
      <script src="assets/js/logsign.js"></script>

    </body>

  </html>
