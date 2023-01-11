<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="background-image: url('../images/bg88.jpg')">

<?php include '../components/admin_header.php' ?>

<section class="dashboard">

   <h1 class="heading">ADMINISTRARE</h1>

   <div class="box-container">

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <p>REZERVARI TOTALE</p>
      <h3><?= $numbers_of_orders; ?></h3>
      <a href="reserv_placed.php" class="btn">REZERVARI</a>
   </div>

   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE res_status = ?");
         $select_pendings->execute(['in asteptare']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
         $total_pendings += 1;
         }
      ?>
      <p>REZERVARI IN ASTEPTARE</p>
      <h3><?= $total_pendings; ?><span></span></h3>
      <a href="reserv_placed.php" class="btn">REZERVARI</a>
      </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <p>PRODUSE IN MENIU</p>
      <h3><?= $numbers_of_products; ?></h3>
      <a href="products.php" class="btn">MENIU</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <p>ADMINISTRATORI</p>
      <h3><?= $numbers_of_admins; ?></h3>
      <a href="admin_accounts.php" class="btn">EDITARE ADMINISTRATORI</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <p>UTILIZATORI</p>
      <h3><?= $numbers_of_users; ?></h3>
      <a href="users_accounts.php" class="btn">EDITARE UTILIZATORI</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `reviews`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <p>FEEDBACK-URILE UTILIZATORILOR</p>
      <h3><?= $numbers_of_messages; ?></h3>
      <a href="messages.php" class="btn">REVIEWS</a>
   </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>