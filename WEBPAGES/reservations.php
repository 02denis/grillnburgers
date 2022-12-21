<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../STYLES/meniu.css">
    <link rel="stylesheet" type="text/css" href="../STYLES/logo.css">
    <link rel="stylesheet" type="text/css" href="../STYLES/section.css">
    <link rel="stylesheet" type="text/css" href="../STYLES/blur.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>

<body>
    <section style="background-image: url('../IMAGES/bg4.jpg')">
        <div class="top-nav">
            <div class="logo">
                <a href="../WEBPAGES/index.php" class="left"><img src="../IMAGES/whitelogo.png" style="height:70px"></a>
            </div>
            <input id="menu-toggle" type="checkbox" />
            <label class='menu-button-container' for="menu-toggle">
                <div class='menu-button'></div>
            </label>
            <ul class="menu">
                <li><a href="#" class="inactiveLink">|</a></li>
                <li><a href="../WEBPAGES/menu.php" style="color:#dd7230">MENIU</a></li>
                <li><a href="#" class="inactiveLink">|</a></li>
                <li><a href="../WEBPAGES/reservations.php">REZERVARI</a></li>
                <li><a href="#" class="inactiveLink">|</a></li>
                <li><a href="../WEBPAGES/locations.php">ORAR & LOCATII</a></li>
                <li><a href="#" class="inactiveLink">|</a></li>
                <li><a href="../WEBPAGES/contact.php">CONTACT</a></li>
            </ul>
        </div>
        <div style="color:#dd7230; padding-top: 15%; text-align: center; width:50%; font-size:50px">
            REZERVARE
        </div>
        <br>
        <div style="color:#dd7230;text-align: center; width:50%">
            <form action="#">
                <label for="fname" style="font-size:40px">Nume:</label><br>
                <input type="text" id="fname" name="fname" value=""><br>
                <br>
                <label for="lname" style="font-size:40px">Prenume:</label><br>
                <input type="text" id="lname" name="lname" value=""><br>
                <br>
                <label for="lname" style="font-size:40px">Numar persoane:</label><br>
                <input type="text" id="lname" name="lname" value=""><br>
                <br>
                <label for="lname" style="font-size:40px">Masa:</label><br>
                <input type="text" id="lname" name="lname" value=""><br><br>
                <input type="submit" value="SUBMIT" style="color: red">
            </form>

        </div>
</body>

</html>