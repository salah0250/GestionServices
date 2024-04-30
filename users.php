<?php 
session_name("log");
session_start();
include "db_conn.php";

if(!isset($_SESSION['unique_id'])){
	header("Location:signin.php");
}
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="./profil/upload/<?php echo $row['photo']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['name']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
      </header>
 
      <div class="users-list">
      <?php
          $outgoing_id = $_SESSION['unique_id'];
          $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id  DESC";
          $query = mysqli_query($conn, $sql);
          $output = "";
          if(mysqli_num_rows($query) == 0){
              $output .= "No users are available to chat";
          }elseif(mysqli_num_rows($query) > 0){
              include_once "php/data.php";
          }
          echo $output;
        ?>
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
