<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/products.css">
   <link rel="stylesheet" href="css/contact.css">
   <link rel="stylesheet" href="css/checkout.css">
   <link rel="stylesheet" href="css/orders_forms.css">

</head>
<body style="background-image: url('./images/greybg.jpg')">
   
<?php include 'components/user_header.php'; ?>

<section class="user-details">

   <div class="user">
      <img src="images/logo.png" alt="">
      <p><i class="fas fa-user" style="color:#dd7230"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
      <p><i class="fas fa-phone" style="color:#dd7230"></i><span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope" style="color:#dd7230"></i><span><?= $fetch_profile['email']; ?></span></p>
      <br><br><a href="update_profile.php" class="btn-user" style="margin-top:20px">Modifica</a>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>