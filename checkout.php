<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name);
   $number = $_POST['number'];
   $number = filter_var($number);
   $email = $_POST['email'];
   $email = filter_var($email);
   $method = $_POST['method'];
   $method = filter_var($method);
   $time = $_POST['meeting-time'];
   $time = filter_var($time);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, meeting_time, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $time, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      echo '<script>alert("Rezervare facuta cu succes. Asteapta confirmarea!"); window.location = "reservation.php";</script>';
   }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
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

   <section class="checkout">

      <h1 class="title">Detalii rezervare</h1>

      <form action="" method="post">

         <div class="cart-items">
            <?php
            $grand_total = 0;
            $cart_items[] = '';
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
                  <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price" style="color: white">RON <?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
            <?php
               }
            }
            ?>
            <p class="grand-total"><span class="name" style="color:black">Total de plata:</span><span class="price">RON<?= $grand_total - 1; ?></span></p>
            <a href="cart.php" class="btn">Editare</a>
         </div>

         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total - 1; ?>" value="">
         <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
         <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
         <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">

         <div class="user-info">
            <p><i class="fas fa-user" style="color:#dd7230"></i><span><?= $fetch_profile['name'] ?></span></p>
            <p><i class="fas fa-phone" style="color:#dd7230"></i><span><?= $fetch_profile['number'] ?></span></p>
            <p><i class="fas fa-envelope" style="color:#dd7230"></i><span><?= $fetch_profile['email'] ?></span></p>
            <br>
            <label> Alegeti data si ora:</label><br>
            <input type="datetime-local" id="meeting-time" name="meeting-time" value="" min="2023-01-01T19:30" max="2099-12-12T19:30" style="color: black">
            <br><br>
            <label> Alegeti o masa:</label><br>
            <select name="res_status" class="drop-down" style="color:black">
               <option value="t1" style="color:black">Masa 1 - 2 persoane</option>
               <option value="t2" style="color:black">Masa 2 - 1 persoana</option>
               <option value="t3" style="color:black">Masa 3 - 2 persoane</option>
               <option value="t4" style="color:black">Masa 4 - 2 persoane</option>
               <option value="t5" style="color:black">Masa 5 - 2 persoane</option>
            </select><br><br>
            <input type="submit" value="REZERVA" class="btn" name="submit">
         </div>

      </form>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>