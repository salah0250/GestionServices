
<?php
session_name("log");
session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    include "db_conn.php";

    require './vendor/autoload.php';
    $id=$_SESSION['unique_id'];
if (isset($_POST["verify"]))
{
    $mail = new PHPMailer(true);
    $email = $_POST["new_email"];
    try {
        //Enable verbose debug output
        $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

        
        $mail->isSMTP();


        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'projet.terd@gmail.com';


        $mail->Password = 'ewcbpvisnmfknbbr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        $mail->Port = 465; //ou 587
        $mail->SMTPSecure ='ssl';
     
        $mail->setFrom('projet.terd@gmail.com');

        //Add a recipient
        //$mail->addAddress($email, $name);
        $mail->addAddress($email);

        //Set email format to HTML
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email reset';


        $mail->Body    = '<style type="text/css">

p[class=footer-content-left] { text-align: center !important; }

img { height: auto; line-height: 100%;}
 } 

body { background-color: #ececec; margin: 0; padding: 0; }
img { outline: none; text-decoration: none; display: block;}
br, strong br, b br, em br, i br { line-height:100%; }
table td, table tr { border-collapse: collapse; }
#background-table { background-color: #ececec; }
#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }
body, td { font-family: HelveticaNeue, sans-serif; }
.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
.header-content { font-size: 12px; color: #e7cba3; }
#headline p { color: #e7cba3; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }
.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }
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
                                        <multiline label="Description">The code to confirm your new email is:  <b style="font-size: 30px;">' . $verification_code . '</b></multiline>
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
        $mail->send();
        
        $sql = "UPDATE users SET verification_code='". $verification_code ."' WHERE unique_id='".$id."'";

        mysqli_query($conn, $sql);
        $_SESSION['new_email']=$email;
        header("Location: change-e3.php?success=OKKK");
         
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="assets/css/verification.css">
    <title>e-service</title>
</head>
<body>
<div class="container">
<form method="POST">
    <p>Inserer votre nouvelle adresse email </p>
    <input type="email" name="new_email" placeholder="Enter your new email" required />

    <input type="submit" name="verify" value="Envoyer">
	<br>
	<br>
	<a href='/new/index2.php'>back home</a>
</form></div></html>
