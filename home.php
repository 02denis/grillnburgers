<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
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
  
   <section>
   <div class="text-msg">
      GATIM CU PASIUNE<br>
      PE GUSTUL TAU
   </div>
   </section>

   <section style="background-image: url('../IMAGES/BG88.jpg')">
      <div class="about" style="color:#dd7230">
         DESPRE NOI..
      </div>
      <br>
      <div class="text-intro">
         Grilln'Burgers a apărut din pasiunea noastră pentru mâncarea
         delicioasă și atmosfera prietenoasă! <br>
         Situat în inima Timișoarei, restaurantul
         nostru este gazda ideală pentru a petrece timp de calitate alături de familie,
         prieteni sau parteneri de afaceri.
         <br><br>
         Pentru că ne dorim ca experiența avută la noi
         să fie asezonată cu o notă de calitate și bun gust, am conceput un meniu alături de
         Chef-ul nostru, absolut fermecător pentru papilele gustative.
         <br><br>
         Mergem prin bucătăriile
         lumii și găsim preparate savuroase demne de premiat.
         Pe lângă atmosfera minunată, relaxantă, ca de vacanță, vă așteptăm cu cele mai bune preparate,
         toate gătite cu pasiune, dar și cu cele mai răcoroase și fine băuturi.
      </div>

   </section>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <?php include 'components/footer.php'; ?>
</body>

</html>