<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="background-image: url('../images/greybg.jpg')">

<?php include '../components/admin_header.php' ?>


<section class="messages">

   <h1 class="heading">FEEDBACK</h1>

   <div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `reviews`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Nume: <span><?= $fetch_messages['name']; ?></span> </p>
      <p> Numar telefon: <span><?= $fetch_messages['number']; ?></span> </p>
      <p> Email: <span><?= $fetch_messages['email']; ?></span> </p>
      <p> Feedback: <span><?= $fetch_messages['message']; ?></span> </p>
      <a style="margin-top:20px" href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick="return confirm('Stergi mesajul?');">Sterge</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Nu sunt recenzii!</p>';
      }
   ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>