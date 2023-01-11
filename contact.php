<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   echo '<script>alert("Trebuie sa intri in cont pentru a trimite un feedback!"); window.location = "login.php";</script>';
   exit;
};

if (isset($_POST['send'])) {

   $name = $_POST['name'];
   $name = filter_var($name);
   $email = $_POST['email'];
   $email = filter_var($email);
   $number = $_POST['number'];
   $number = filter_var($number);
   $msg = $_POST['msg'];
   $msg = filter_var($msg);

   $select_message = $conn->prepare("SELECT * FROM `reviews` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if ($select_message->rowCount() > 0) {
      echo '<script>alert("Ati mai lasat acelasi review!"); window.location = "contact.php";</script>';
   } else {

      $insert_message = $conn->prepare("INSERT INTO `reviews`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      echo '<script>alert("Review trimis cu succes!"); window.location = "contact.php";</script>';

   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
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

   <section class="contact">

      <div class="row">
         <form action="" method="post">
            <h3>Lasa-ne o parere!</h3>
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" class="box" maxlength="50" readonly>
            <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" readonly class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="number" name="number" value="<?= $fetch_profile['number']; ?>" readonly class="box" min="0" max="9999999999" maxlength="10">

            <textarea name="msg" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="Trimite" name="send" class="btn">
         </form>

      </div>

   </section>
   
   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>