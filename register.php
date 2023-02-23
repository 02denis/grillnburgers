<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name);
   $email = $_POST['email'];
   $email = filter_var($email);
   $number = $_POST['number'];
   $number = filter_var($number);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      echo '<script>alert("Numar de telefon sau email existent!!"); window.location = "register.php";</script>';

   }else{
      if($pass != $cpass){
         echo '<script>alert("Parolele nu corespund!"); window.location = "register.php";</script>';

      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];

            $mail = new PHPMailer(true);
   
            $mail->isSMTP();  
            $mail->Host='smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'senis022@outlook.com';
            $mail->Password = 'Apaplata112@';

            $mail->setFrom('senis022@outlook.com');

            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Activare cont';
            $mail->Body = 'Cont creat cu succes!';
            
            $mail->send();



            header('location:home.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
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

<section class="form-container">

   <form action="" method="post">
      <h3>Creeaza un cont!</h3>
      <input type="text" name="name" required placeholder="Nume" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="Email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="Numar de telefon" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="pass" required placeholder="Parola" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirma parola" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Inregistrare" name="submit" class="btn">
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>