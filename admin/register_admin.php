<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0){
      echo '<script>alert("Nume de utilizator existent!"); window.location = "register_admin.php";</script>';
   }else{
      if($pass != $cpass){
         echo '<script>alert("Parolele nu corespund"); window.location = "register_admin.php";</script>';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         echo '<script>alert("Cont creat cu succes!"); window.location = "register_admin.php";</script>';
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
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="background-image: url('../images/greybg.jpg')" >

<?php include '../components/admin_header.php' ?>


<section class="form-container">

   <form action="" method="POST">
      <h3>Creeaza un nou administrator</h3>
      <input type="text" name="name" maxlength="20" required placeholder="nume de utilizator" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="parola" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="confirma parola" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="CREEAZA" name="submit" class="btn">
      <a href="admin_accounts.php"  value="ADMINS" name="submit" class="btn" >ADMINS</a>
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>