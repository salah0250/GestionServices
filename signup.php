<?php
session_name("log");
session_start();
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require './vendor/autoload.php';
    include "db_conn.php";

    if (isset($_POST["submit"]))
    {
      
        $name = $_POST["nom"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $ran_id = rand(time(), 100000000);
        $status = "active now";
		$cpass = $_POST["conpassword"];
		//$conn = mysqli_connect('localhost','root','','prova');
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
		$select = "SELECT * FROM users WHERE email ='$email'";
		$result = mysqli_query($conn, $select);
		if(mysqli_num_rows($result) > 0){
        $error[]='user already exist!';
    }else{
        if($password != $cpass){
            $error[] = 'password not matched!';
        }else{


        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

            //Send using SMTP
            $mail->isSMTP();

            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';

            //Enable SMTP authentication
            $mail->SMTPAuth = true;

            //SMTP username
            $mail->Username = 'projet.terd@gmail.com';

            //SMTP password
            $mail->Password = 'ewcbpvisnmfknbbr';

            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 465; //ou 587
			$mail->SMTPSecure ='ssl';
            //Recipients
            $mail->setFrom('projet.terd@gmail.com');

            //Add a recipient
            $mail->addAddress($email, $name);

            //Set email format to HTML
            $mail->isHTML(true);

            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $mail->Subject = 'Email verification';
            $mail->Body    = '<style type="text/css">

p[class=footer-content-left] { text-align: center !important; }

img { height: auto; line-height: 100%;}
 } 
/* Client-specific Styles */
#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */
body { width: 100% !important; min-width: 100%; }
.ReadMsgBody { width: 100%; }
.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
.gmail {margin: 0 auto; width: 670px; min-width: 670px; border-spacing: 0;} /* Force min width on Gmail web*/
.gmail td {font-size: 0; line-height: 0; padding: 0;}

body { background-color: #ececec; margin: 0; padding: 0; }
img { outline: none; text-decoration: none; display: block;}
br, strong br, b br, em br, i br { line-height:100%; }
h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }
/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
table td, table tr { border-collapse: collapse; }
.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
}	
#background-table { background-color: #ececec; }
/* Webkit Elements */
#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #043948; color: #e7cba3; }
#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }
/* Fonts and Content */
body, td { font-family: HelveticaNeue, sans-serif; }
.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */
.header-content { font-size: 12px; color: #e7cba3; }
.header-content a { font-weight: bold; color: #e7cba3; text-decoration: none; }
#headline p { color: #e7cba3; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }
#headline p a { color: #e7cba3; text-decoration: none; }
.article-title { font-size: 18px; line-height:24px; color: #9a9661; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }
.article-title a { color: #9a9661; text-decoration: none; }
.article-title.with-meta {margin-bottom: 0;}
.article-meta { font-size: 13px; line-height: 20px; color: #8e9aad; font-weight: bold; margin-top: 0;}
.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }
.article-content a { color: #00707b; font-weight:bold; text-decoration:none; }
.article-content img { max-width: 100% }
.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }
.article-content li { font-size: 13px; line-height: 18px; color: #444444; }
.article-content li a { color: #00707b; text-decoration:underline; }
.article-content p {margin-bottom: 15px;}
.footer-content-left { font-size: 12px; line-height: 15px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
.footer-content-left a { color: #e7cba3; font-weight: bold; text-decoration: none; }
.footer-content-right { font-size: 11px; line-height: 16px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
.footer-content-right a { color: #e7cba3; font-weight: bold; text-decoration: none; }
#footer { background-color: #043948; color: #e2e2e2; }
#footer a { color: #e7cba3; text-decoration: none; font-weight: bold; }
#permission-reminder { white-space: normal; }
#street-address { color: #e7cba3; white-space: normal; }
</style>

<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">
	<tbody><tr>
		<td align="center" bgcolor="#ececec">
        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>
                
            	<tr>
                	<td class="w640" width="640">
                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#00707b">
    <tbody><tr>
        
        <td class="w325" width="350" valign="middle" align="left">
            
            
        </td>
        <td class="w30" width="30"></td>
        <td class="w255" width="255" valign="middle" align="right">
            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr><td class="w255" width="255" height="8"></td></tr>
            </tbody></table>
            <table cellpadding="0" cellspacing="0" border="0">
    <tbody><tr>
	    <td valign="middle"><div class="header-content">Suivez-nous!</div></td>

        
        <td valign="middle"><fblike><img src="https://img.createsend1.com/img/templatebuilder/like-glyph.png" border="0" width="8" height="14" alt="Facebook icon"=""></fblike></td>
        <td valign="middle"><div class="header-content"><fblike> Facebook</fblike></div></td>
		<td width="3"></td>        
        
        <td class="w10" width="10"></td>
        <td valign="middle"><tweet><img src="https://img.createsend1.com/img/templatebuilder/tweet-glyph.png" border="0" width="17" height="13" alt="Twitter icon"=""></tweet></td>
        <td width="3"></td>
        <td valign="middle"><div class="header-content"><tweet>Twitter</tweet></div></td>
        
        
        
        
    </tr>
</tbody></table>
            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr><td class="w255" width="255" height="8"></td></tr>
            </tbody></table>
        </td>
        <td class="w15" width="15"></td>
    </tr>
</tbody></table>
                        
                    </td>
                </tr>
                <tr>
                <td id="header" class="w640" width="640" align="center" bgcolor="#00707b">
    
    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>
        <tr>
            <td class="w30" width="30"></td>
            <td class="w580" width="580">
                <div align="center" id="headline">
                    <p>	
                        <strong><img src="https://i.postimg.cc/dV1wBWQ4/black-logo.png"></strong>
                    </p>
                </div>
            </td>
            <td class="w30" width="30"></td>
        </tr>
    </tbody></table>
    
    
</td>
                </tr>
                
                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>
                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">
    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
        <tbody><tr>
            <td class="w30" width="30"></td>
            <td class="w580" width="580">
                <repeater>
                    
                    <layout label="Text only">
                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                            <tbody><tr>
                                <td class="w580" width="580">
                                    <p align="left" class="article-title"><singleline label="Title">Verification</singleline></p>
                                    <div align="left" class="article-content">
                                        <multiline label="Description">Bonjour '.$name.' le code de verification est: <b style="font-size: 30px;">' . $verification_code . '</b></multiline>
                                    </div>
                                </td>
                            </tr>
                            <tr><td class="w580" width="580" height="10"></td></tr>
                        </tbody></table>
                    </layout>
                                                                    
                    
                           
                    
                    <layout label="Image gallery">
                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                            <tbody><tr>
                                <td class="w180" width="180" valign="top">
                                    <table class="w180" width="180" cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr>
                                            <td class="w180" width="180"><img editable="true" label="Image" class="w180" width="180" border="0"></td>
                                        </tr>
                                        <tr><td class="w180" width="180" height="10"></td></tr>
                                       
                                        <tr><td class="w180" width="180" height="10"></td></tr>
                                    </tbody></table>
                                </td>
                                
</td></tr>
                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>
                
                <tr>
                <td class="w640" width="640">
    <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#043948">
        <tbody><tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="30"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
        <tr>
            <td class="w30" width="30"></td>
            <td class="w580" width="360" valign="top">
            <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"></p></span>
            <p align="right" class="footer-content-right"><preferences lang="en">Contact</preferences> | <unsubscribe>projet.terd@gmail.com</unsubscribe></p>
            </td>
            <td class="hide w0" width="60"></td>
            <td class="hide w0" width="160" valign="top">
            <p id="street-address" align="right" class="footer-content-right">@E-Service2023</p>
            </td>
            <td class="w30" width="30"></td>
        </tr>
        <tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="15"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
    </tbody></table>
</td>
                </tr>
                <tr><td class="w640" width="640" height="60"></td></tr>
            </tbody></table>
        </td>
	</tr>
</tbody></table>';
 
//<p>Hi '.$name.' your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

            $mail->send();
            $_SESSION['emailv']=$email;
            // echo 'Message has been sent';

            //$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $encrypted_password = md5($password);
            // connect with database
			//$conn = mysqli_connect('localhost','root','','prova');
            // insert in users table
            $sql = "INSERT INTO users(unique_id,name,lname, email, password, verification_code, email_verified_at,status) VALUES ('". $ran_id ."','" . $name . "','" . $lname . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL,'". $status ."')";
            mysqli_query($conn, $sql);

            
            header("Location: verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }}}
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

    <title>signup</title>

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
            <a href="index.html" class="logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.html">Accueil</a></li>
              <li><a href="search.html">Recherche</a></li>
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
  
    <div class="popular-categories">
      <div class="container">
        <div class="row">
          <div class="containerBis right-pannel-active" id="containerBis">
            <div class="form-containerBis sign-up-containerBis">
            <form action="#" method="post">
                <br><br>
                <h1>Create An Account</h1>
                <br>
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
                <input type="text" name="nom" placeholder="First Name"/>
                <input type="text" name="lname" placeholder="Last Name"/>
                <input type="email" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password"/>
                <input type="password" name="conpassword" placeholder="Confirmation password"/>
                <input type="submit" name="submit" placeholder="Sign in">
              </form>
              </form>
            </div>
            <div class="overlay-containerBis">
              <div class="overlay">
                <div class="overlay-pannel overlay-left">
                  <h1>Have Already Account?</h1>
                  <p>To keep connect with us please login with your account
                    here!</p>
                  <a href="signin.php">
                    <button class="ghost">Sign In</button>
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
