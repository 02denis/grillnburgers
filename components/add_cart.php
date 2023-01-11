<?php

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid);
      $name = $_POST['name'];
      $name = filter_var($name);
      $price = $_POST['price'];
      $price = filter_var($price);
      $image = $_POST['image'];
      $image = filter_var($image);
      $qty = $_POST['qty'];
      $qty = filter_var($qty);


      $image_path = "./mese.png";

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute(["Rezervare", $user_id]);

      if($check_cart_numbers->rowCount() <= 0){
      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, 100, "Rezervare", 1, 1, $image_path]);}


      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);
         
      if($check_cart_numbers->rowCount() > 0){
         echo '<script>alert("Produsul este deja in meniu, dar puteti sa ii modificati cantitatea!"); window.location = "cart.php";</script>';

      }else{
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         echo('Produs adaugat cu succes!');
         
      }

   }

}
