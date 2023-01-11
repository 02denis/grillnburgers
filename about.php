<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
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

    <section class="about">

        <div class="row">
            <div class="content">
                <h3 style="font-size: 7rem">ORAR & CATEVA CUVINTE</h3>
                <div style="font-size:24px"><br>
                    ..Grilln'Burgers a apărut din pasiunea noastră pentru mâncarea delicioasă și atmosfera prietenoasă!
                    Situat în inima Timișoarei, restaurantul nostru este gazda ideală pentru a petrece timp de calitate alături de familie, prieteni sau parteneri de afaceri. </div>
                <p>Timisoara: Strada Barbu Iscovescu 2 - 08-22 -<button id="button1">Vezi harta</button></p><br>
                <div id="iframeHolder1"></div>
            </div>

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>


</body>

</html>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#button1').click(function() {
            if (!$('#iframe').length) {
                $('#iframeHolder1').html('<iframe id="iframe1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5568.137328843842!2d21.23247987738162!3d45.749769366421354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d87fceb592f%3A0x8c13fcb393af4189!2sRestaurant%20Dinar!5e0!3m2!1sro!2sro!4v1673355616180!5m2!1sro!2sro" width="700" height="450"></iframe>');
            }
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#button2').click(function() {
            if (!$('#iframe').length) {
                $('#iframeHolder2').html('<iframe id="iframe2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5568.137328843842!2d21.23247987738162!3d45.749769366421354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d87fceb592f%3A0x8c13fcb393af4189!2sRestaurant%20Dinar!5e0!3m2!1sro!2sro!4v1673355616180!5m2!1sro!2sro" width="700" height="450"></iframe>');
            }
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#button3').click(function() {
            if (!$('#iframe').length) {
                $('#iframeHolder3').html('<iframe id="iframe3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5568.137328843842!2d21.23247987738162!3d45.749769366421354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d87fceb592f%3A0x8c13fcb393af4189!2sRestaurant%20Dinar!5e0!3m2!1sro!2sro!4v1673355616180!5m2!1sro!2sro" width="700" height="450"></iframe>');
            }
        });
    });
</script>