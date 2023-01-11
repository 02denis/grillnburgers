<header class="header">

   <section class="flex">

   <a href="dashboard.php" class="logo"><img src="../images/whitelogo.png" style="height:50px"></a>
      <nav class="navbar">
         <a href="products.php" style="color:#dd7230">meniu</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="add.php">adauga produse</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="reserv_placed.php" style="color:#dd7230">rezervari</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="users_accounts.php">utilizatori</a>
         <a href="#" class="inactiveLink">|</a>
         <a href="messages.php" style="color:#dd7230">reviews!</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p style="color: white"><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">EDIT</a>
         <div class="flex-btn">
            <a href="register_admin.php" class="option-btn">INREG.</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('Esti sigur ca vrei sa faci asta?');" class="delete-btn">LOGOUT</a>
      </div>

   </section>

</header>