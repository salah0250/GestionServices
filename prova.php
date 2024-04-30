<?php  
session_name("log");
session_start();
include "db_conn.php";

$a=$_SESSION["control"];
$email=$_SESSION["emmm"];
$id=$_SESSION["unique_id"];
if(!$a){
	header("Location:login.php");
}
//$conn = mysqli_connect('localhost','root','','prova');
if ($a) {



if(isset($_POST['envoyer'])){


    $fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$tel = $_POST['tel'];
	$descr = $_POST['desc'];
	$ville = $_POST['ville'];


	
    $old_pp = $_POST['old_pp'];

    if (empty($fname)) {
    	header("Location: ./profilm.php?error=Nom est obligatoire");
	    exit;
    }else {

      if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
        
         $img_name = $_FILES['pp']['name'];
         $tmp_name = $_FILES['pp']['tmp_name'];
         $error = $_FILES['pp']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($email, true).'.'.$img_ex_to_lc;
               $img_upload_path = './profil/upload/'.$new_img_name;
               // Delete old profile pic
               $old_pp_des = "./profil/upload/$old_pp";
               if(unlink($old_pp_des)){
               	  // just deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  // error or already deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
               

               // update the Database
               $sql = "UPDATE users 
                       SET name=?, lname=?, photo=?, telephone=?, description=?, ville=?
                       WHERE unique_id=?";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $lname, $new_img_name, $tel,$descr,$ville,$id]);
               $_SESSION['name'] = $fname;
               $_SESSION['email'] = $email;
               $_SESSION['photo'] = $new_img_name;
               $_SESSION['id'] = $id;
               header("Location: profil.php?success=Your account has been updated successfully");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: profil.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: profil.php?error=$em&$data");
            exit;
         }

        
      }else {
       	$sql = "UPDATE users 
                    SET name=?, lname=?, telephone=?, description=?, ville=?
                    WHERE unique_id=?";
                $_SESSION['name'] = $fname;
                $_SESSION['email'] = $email;
                //$_SESSION['photo'] = $new_img_name;
                $_SESSION['unique_id'] = $id;
       	$stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $lname,$tel,$descr,$ville,$id]);

       	header("Location: profil.php?success=Your account has been updated successfully");
   	    exit;
      }
    }


}else {
	header("Location: profil.php?error=error");
	exit;
}


}else {
   
           header("Location: profil.php?error=succesfull");
           exit;
} 

