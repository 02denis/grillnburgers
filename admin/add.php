<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name);
   $price = $_POST['price'];
   $price = filter_var($price);
   $category = $_POST['category'];
   $category = filter_var($category);

   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      echo '<script>alert("Exista deja un produs cu acelasi nume!"); window.location = "add.php";</script>';
   }else{
      if($image_size > 2000000){
         echo '<script>alert("Imaginea este prea mare"!"); window.location = "add.php";</script>';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         echo('Produsul a fost adaugat cu succes!');
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="background-image: url('../images/greybg.jpg')">

<?php include '../components/admin_header.php' ?>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>ADAUGA PRODUS</h3>
      <input type="text" required placeholder="numele produsului" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="pretul produsului" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>alege categoria</option>
         <option value="aperitiv" style="color: black">Aperitiv</option>
         <option value="fel_principal" style="color: black">Fel principal</option>
         <option value="desert" style="color: black">Desert</option>
         <option value="bautura" style="color: black">Bautura</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="ADAUGA" name="add_product" class="btn">
   </form>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>