<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['update_res'])) {

   $order_id = $_POST['order_id'];
   $res_status = $_POST['res_status'];
   $email_ord = $_POST['email_ord'];
   $update_status = $conn->prepare("UPDATE `orders` SET res_status = ? WHERE id = ?");
   $update_status->execute([$res_status, $order_id]);
   echo ('Modificare efectuata!');
   $mail = new PHPMailer(true);

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'washu.origins@gmail.com';
   $mail->Password = 'awvufmvojduvwclc';

   $mail->setFrom('washu.origins@gmail.com');

   $mail->addAddress($email_ord);

   $mail->isHTML(true);
   $mail->Subject = 'Rezervare confirmata!';
   $mail->Body = 'Rezervarea dumneavoastra s-a confirmat! Daca ati optat pentru un meniu acesta va fi pregatit la sosirea dumneavoastra. Va asteptam!';

   $mail->send();
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:reserv_placed.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reservations</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body style="background-image: url('../images/greybg.jpg')">

   <?php include '../components/admin_header.php' ?>

   <section class="placed-orders">

      <h1 class="heading">Rezervari</h1>

      <div class="box-container">

         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> ID: <span><?= $fetch_orders['user_id']; ?></span> </p>
                  <p> Data plasarii: <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> Nume: <span><?= $fetch_orders['name']; ?></span> </p>
                  <p> Email: <span><?= $fetch_orders['email']; ?></span> </p>
                  <p> Numar de telefon: <span><?= $fetch_orders['number']; ?></span> </p>
                  <p> Data rezervarii : <span><?= $fetch_orders['meeting_time']; ?></span> </p>
                  <p> Total produse: <span><?= $fetch_orders['total_products']; ?></span> </p>
                  <p> Pret total: <span>$<?= $fetch_orders['total_price']; ?></span> </p>
                  <p> Modalitate de plata: <span><?= $fetch_orders['method']; ?></span> </p>
                  <form action="" method="POST">
                     <input type="hidden" name="email_ord" value="<?= $fetch_orders['email']; ?>">
                     <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                     <select name="res_status" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['res_status']; ?></option>
                        <option value="in asteptare" style="color:red">in asteptare</option>
                        <option value="confirmat" style="color:green">confirmat</option>
                     </select>
                     <div class="flex-btn">
                        <input style="border: none" type="submit" value="update" class="btn" name="update_res">
                        <a href="reserv_placed.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                     </div>
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Nu sunt rezervari!</p>';
         }
         ?>

      </div>

   </section>

   <script src="../js/admin_script.js"></script>

</body>

</html>