<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   echo '<script>alert("Trebuie sa intri in cont pentru a face o rezervare!"); window.location = "login.php";</script>';
   exit;
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/products.css">
   <link rel="stylesheet" href="css/contact.css">
   <link rel="stylesheet" href="css/checkout.css">
   <link rel="stylesheet" href="css/orders_forms.css">

</head>

<body style="background-image: url('./images/bg88.jpg')">

   <?php include 'components/user_header.php'; ?>

   <br><br><br>
   <h1 class="title" style="text-shadow:0 0 5px black;">Rezervarile mele</h1>
   <div>
      <a href="cart.php" class="button-ord">Fa o rezervare!</a>
   </div>
   <section class="orders">

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">Logheaza-te pentru a vedea rezervarile</p>';
         } else {
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
                  <div class="box">
                     <p>Data plasării: <span><?= $fetch_orders['placed_on']; ?></span></p>
                     <p>Nume: <span><?= $fetch_orders['name']; ?></span></p>
                     <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
                     <p>Telefon: <span><?= $fetch_orders['number']; ?></span></p>
                     <p>Data rezervării: <span><?= $fetch_orders['meeting_time']; ?></span></p>
                     <p>Metodă plată: <span><?= $fetch_orders['method']; ?></span></p>
                     <p>Meniu: <span><?= $fetch_orders['total_products']; ?></span></p>
                     <p>Preț total: <span>RON<?= $fetch_orders['total_price']; ?></span></p>
                     <p>Status: <span style="color:<?php if ($fetch_orders['res_status'] == 'in asteptare') {
                                                      echo 'red';
                                                   } else {
                                                      echo 'green';
                                                   }; ?>"><?= $fetch_orders['res_status']; ?></span> </p>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">Momentan nu aveti nici o rezervare!</p>';
            }
         }
         ?>

      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>