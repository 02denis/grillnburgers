<header class="header">
   <div class="flex">
      <a href="home.php" class="logo"><img src="images/whitelogo.png" style="height:50px"></a>
      <nav class="navbar">
         <a href="home.php">ACASA</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="menu.php">MENIU</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="reservation.php" style="color: #dd7230">REZERVARE</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="about.php">DESPRE NOI</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="contact.php" style="color: #dd7230">FEEDBACK</a>
      </nav>

      <div class="icons">
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user" style="color: #dd7230;"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
               <a href="profile.php" class="btn">Profil</a>
               <a href="components/user_logout.php" onclick="return confirm('Esti sigur ca vrei sa faci asta?');" class="delete-btn">Logout</a>
            </div>
         <?php
         } else {
         ?>
            <p class="name">Intră în cont înainte!</p><br>
            <a href="login.php" class="btn">logare</a><br>
         <?php
         }
         ?>
      </div>

   </div>

</header>