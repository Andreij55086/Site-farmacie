


<nav id="meniu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?page=1">Adauga date personale ale unui pacient</a></li>
            <li><a href="index.php?page=2">Afisare pacienti</a></li>
                   <li><a href="index.php?page=3">Medicamente</a></li>
                    <li><a href="index.php?page=4">Afisare medicamente</a></li>
        <li><a href="index.php?logout">Logout</a></li>
    </ul>
</nav>
<section id="continut">
<?php 
if (isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php"); //redirect la index, unde o sa se verifice sesiunea si pt ca nu mai exista, 
    //o sa se incarce template_neconectat
}

if (isset($_SESSION['welcome'])) {
    print $_SESSION['welcome']; //afisez o singura data, prima oara cand ajung in pagina, din autologin
    unset($_SESSION['welcome']);
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 1:
            require_once 'pagini/conectat/adauga_date.php';
            break;
        case 2:
            require_once 'pagini/conectat/afisare_clienti.php';
            break;
        
        case 3:
            require_once 'pagini/conectat/medicamente.php';
            break;
        
        case 4:
            require_once 'pagini/conectat/afisaremedicamente.php';
            break;
          case 5:
            require_once 'pagini/conectat/cos_cumparaturi.php';
            break;
        
        default:
            require_once 'pagini/eroare.php';
    }
} else {
    require_once 'pagini/neconectat/home.php';
}

?>    
    
    
</section>