<html>
<header>
    <h1>Farmacia InfoWorld</h1>
    <div class="image-wrapper">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Indian_Pharmacist_Identification_Mark.svg/240px-Indian_Pharmacist_Identification_Mark.svg.png" alt="Imaginea nu exista..." width="100px" height="100px">
    </div>
    <div id="button">
        <button onclick="location.href='index.php?page=5'">Cos Cumparaturi</button>
    </div>
    <div class="search-wrapper">
        <input type="search" placeholder="Search blabla...">
    </div>
</header>
  
<?php 
require_once 'functii/functii.php';
session_start();
if (isset($_POST['conectare'])) {
    $email = $_POST['email_utilizator'];
    $pass = $_POST['pass'];
    $rezultatConectare = conectare($email, $pass);
    if ($rezultatConectare) {
        if (isset($_SESSION['eroare_login'])) {
            unset($_SESSION['eroare_login']);
        }
        $_SESSION['email'] = $email;
    } else {
        $_SESSION['eroare_login'] = 'Conectare esuata';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
     
        <div class="container">
            <div class="main-content">
                <header id="banner"></header>
                <?php
                if (isset($_SESSION['email'])) {
                    require_once 'templates/template_conectat.php';
                } else {
                    require_once 'templates/template_neconectat.php';
                }
                ?>
            </div>  
           
      
        <footer>
            <div class="contact">
                <h2>Contact:</h2>
                <p id="email"><strong>Email:</strong> andrei_jercan@yahoo.com</p>
                <p id="telefon"><strong>Telefon:</strong> 0722222222</p>
            </div>
            <div class="social-media">
                <h2>Social media</h2>
                <img id="facebook-image" src="https://image.flaticon.com/icons/png/512/33/33702.png">
                <a class="facebook-link" href="https://www.facebook.com/andrei.jercan.161/">Jercan Sabin Andrei</a>
                <img class="instagram-image" src="https://i1.wp.com/www.vectorico.com/wp-content/uploads/2018/02/Instagram-Logo.png?resize=300%2C300">
                <a class="instagram-link" href="https://www.instagram.com/andreij04/">Andreij04</a>
            </div>
            <p id="copyright">&copy; Jercan Sabin Andrei</p>
        </footer>
    </body>
</html>

<style><!-- comment -->
    html,
body {
  height: 100%;
}

.container {
  display: flex;
  flex-direction: column;
  min-height: 100%;
}

.main-content {
  flex-grow: 1;
}

footer {
  margin-top: auto;
}
    </style>