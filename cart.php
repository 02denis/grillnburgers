<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];

   $image_path = "./mese.png";

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute(["Rezervare", $user_id]);

   if ($check_cart_numbers->rowCount() <= 0) {
      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, 1, "Rezervare", 1, 1, $image_path]);
   }
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if (isset($_POST['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
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

   <section class="products">

      <h1 class="title">REZERVARE</h1>

      <div class="box-container">

         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('Esti sigur ca vrei sa elimini produsul de pe meniu?');"></button>
                  <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>RON</span><?= $fetch_cart['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="sub-total"> pret: <span>RON<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
               </form>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">Nimic</p>';
         }
         ?>

      </div>

      <div class="cart-total">
         <p>Pret total: <span>RON<?= $grand_total - 1; ?></span></p><br>
      </div>

      <div class="more-btn">
         <a href="checkout.php" class="btn <?= ($grand_total > -1) ? '' : 'disabled'; ?>">Rezerva!</a>
         <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > -1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('Vrei sa-ti configurezi alt meniu?');">Sterge produse</button>
         </form>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>