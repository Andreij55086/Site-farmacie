<?php
function conectareBd(
            $host = 'localhost',
            $user = 'root',
            $password = '',
            $database = 'farmacie'
        )
{
    return mysqli_connect($host, $user, $password, $database);
}

function clearData($input, $link)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    $input = mysqli_real_escape_string($link, $input);
    
    return $input;
}

//inregistrarea utilizatorilor
//1. preia email si parola trimise din formular
//2. verific daca email-ul e deja folosit
//3. daca email-ul nu e folosit, pot face inregistrarea, altfel trebuie sa dau o eroare

//pentru a verifica daca email-ul e deja folosit, facem o fct generala pt a prelua un utilizator dupa email
//daca gasesc utilizatorul => nu pot sa fac inregistrarea
//daca nu gasesc utilizatorul => pot merge mai departe cu inregistrarea

function preiaUtilizatorDupaEmail($adresaEmail)
{
    $link = conectareBd();
    $adresaEmail = clearData($adresaEmail, $link);
    $query = "SELECT * FROM utilizator WHERE  email      =     '$adresaEmail'";
    //                                      nume atr bd          variabila trimisa in fct
    $result = mysqli_query($link, $query); //result set - o structura de date
    //transformam result set in array
    $utilizator = mysqli_fetch_array($result, MYSQLI_ASSOC); //intoarce o singura inregistrare
    
    return $utilizator; //daca nu gaseste userul intoarce null, daca da eroare intoarce false
}

function preiaUtilizatorDupaId($id)
{
    $link = conectareBd();
    $adresaEmail = clearData($id, $link);
    $query = "SELECT * FROM utilizator WHERE  id      =     $id";
    //                                      nume atr bd          variabila trimisa in fct
    $result = mysqli_query($link, $query); //result set - o structura de date
    //transformam result set in array
    $utilizator = mysqli_fetch_array($result, MYSQLI_ASSOC); //intoarce o singura inregistrare
    
    return $utilizator; //daca nu gaseste userul intoarce null, daca da eroare intoarce false
}



function preiadate(){
    $link  = conectareBd();
   // $nume  = clearData($nume, $link);
     //$prenume  = clearData($prenume, $link);
      //$adresaemail  = clearData($adresaemail, $link);
      // $poza_profil  = clearData($poza_profil, $link);
    $query = "SELECT * FROM date_personale ";
    $rezultat = mysqli_query($link,$query);
    $date = mysqli_fetch_all($rezultat,MYSQLI_ASSOC);
    
    return $date;
}

function preiamedicamente(){
    $link  = conectareBd();
   // $nume  = clearData($nume, $link);
     //$prenume  = clearData($prenume, $link);
      //$adresaemail  = clearData($adresaemail, $link);
      // $poza_profil  = clearData($poza_profil, $link);
    $query = "SELECT * FROM medicamente ";
    $rezultat = mysqli_query($link,$query);
    $medicament = mysqli_fetch_all($rezultat,MYSQLI_ASSOC);
    
    return $medicament;
}

//intoarce true pt inregistrare cu succes
//intoarce false in 2 cazuri: userul exista sau a dat eroare insertul
function inregistrare($email, $pass,$nume,$prenume,$cnp,$telefon,$adresa,$varsta)
{
    $link = conectareBd();
    $email = clearData($email, $link);
    $pass = clearData($pass, $link);
     $nume = clearData($nume, $link);
      $prenume = clearData($prenume, $link);
       $cnp = clearData($cnp, $link);
        $telefon = clearData($telefon, $link);
         $adresa = clearData($adresa, $link);
          $varsta = clearData($varsta, $link);
    $pass = md5($pass);
    
    //verificam daca exista deja un user cu adresa de email trimisa
    $user = preiaUtilizatorDupaEmail($email);
    if ($user) { //user nu e null, am gasit deja un cont cu adresa de email trimisa
        return false; //la primul return intalnit, functia se opreste
    }
    
    $query = "INSERT INTO utilizator VALUES(NULL, '$email', '$pass','$nume','$prenume','$cnp','$telefon','$adresa','$varsta')";
    return mysqli_query($link, $query);    
}

//doar cu scop didactic, nu facem asta pe un site pe bune
function preiaUtilizatori()
{
    $link = conectareBd();
    $query = "SELECT id, email FROM utilizator";
    
    $result = mysqli_query($link, $query);
    $utilizatori = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $utilizatori;
}

function conectare($email, $pass) 
{
    $link = conectareBd();
    $email = clearData($email, $link);
    $pass = clearData($pass, $link);
    
    //cautam un utilizator dupa email, daca exista, verificam si parola
    //daca se potriveste parola intoarcem true
    //daca nu se potriveste parola, sau user nu exista intaorcem false
    $user = preiaUtilizatorDupaEmail($email);
    if ($user) { //am gasit user, mai trebuie sa ii verific parola
        //verificare parola
//        if (md5($pass) === $user['parola']) {
//            return true;
//        } else {
//            return false;
//        }
        
        return md5($pass) === $user['parola'];
    }
    
    return false;
}


function adaugadate($nume,$prenume,$cnp,$telefon,$adresa,$varsta)
{
    $link = conectareBd();
    $nume = clearData($nume, $link);
    $prenume = clearData($prenume, $link);
     $cnp = clearData($cnp, $link);
      $telefon = clearData($telefon, $link);
       $adresa = clearData($adresa, $link);
        $varsta = clearData($varsta, $link);
    $query = "INSERT INTO date_personale VALUES(null, '$nume','$prenume', '$cnp','$telefon','$adresa','$varsta')";
    return mysqli_query($link, $query);
    

    
}

function adaugamedicamente($denumire, $gramaj, $forma,$descriere,$lot,$dataexp,$stoc,$pret){
    $link = conectareBd();
    $denumire = clearData($denumire, $link);
    $gramaj = clearData($gramaj, $link);
    $forma = clearData($forma, $link);
    $descriere = clearData($descriere, $link);
    $lot = clearData($lot, $link);
    $dataexp = clearData($dataexp, $link);
    $stoc = clearData($stoc, $link);
    $pret = clearData($pret, $link);
      $query = "INSERT INTO medicamente VALUES(null,'$denumire',' $gramaj',' $forma','$descriere','$lot','$dataexp','$stoc',null,'0','$pret' )";
    return mysqli_query($link, $query);
    
}

function updatestoc($id){
      $link  = conectareBd();
    $query =    "UPDATE  medicamente SET nr_bucati_stoc  = nr_bucati_stoc-1 WHERE id_medicamente = $id";
    
    return mysqli_query($link, $query);
}

function updatecantitate($id){
      $link  = conectareBd();
    $query =    "UPDATE  medicamente SET cantitate  = cantitate+1 WHERE id_medicamente = $id";
    
    return mysqli_query($link, $query);
}
//function updatecantitatefinala($id,$cantitate){
     // $link  = conectareBd();
   // $query =    "UPDATE  medicamente SET cantitate  = 0 WHERE id_medicamente = $id";
    
   // return mysqli_query($link, $query);
//}
function updatestocfinal($id){
      $link  = conectareBd();
 $query = "UPDATE medicamente SET nr_bucati_stoc = nr_bucati_stoc - $cantitate WHERE id_medicamente = $id";
    
    return mysqli_query($link, $query);
}

function afiseazacantitatea($id){
      $link  = conectareBd();
    $query =    "select  cantitate from medicamente WHERE id_medicamente = $id";
    
    return mysqli_query($link, $query);
}
function updateCantitateFinala($id, $disponibilitate) {
  $link = conectareBd();
  $query = "UPDATE medicamente SET cantitate = 0, nr_bucati_stoc = $disponibilitate WHERE id_medicamente = $id";
  return mysqli_query($link, $query);
}
function stergepacientul($id)
{
    $link  = conectareBd();
    $query  = "DELETE FROM date_personale WHERE id = $id";
    
    return mysqli_query($link, $query);
}

function stergemedicamentul($id)
{
    $link  = conectareBd();
    $query  = "DELETE FROM medicamente WHERE id_medicamente = $id";
    
    return mysqli_query($link, $query);
}

function updatenumelepacientului2($numenou,$id){
    $link  = conectareBd();
    
    $query =    "UPDATE  date_personale SET nume = '$numenou' WHERE id = $id";
     
    
        return mysqli_query($link, $query);
    
    
    
}
function updatetest($idpacient, $numenou, $variabila){
  $link = conectareBd();
  $query = "UPDATE medicamente SET $variabila = ? WHERE id_medicamente = ?";
  $stmt = mysqli_prepare($link, $query);

  if (!$stmt) {
    die('Eroare de preparare a declarației SQL: ' . mysqli_error($link));
  }

  mysqli_stmt_bind_param($stmt, 'si', $numenou, $idpacient);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    return true;
  } else {
    return false;
  }
}


function getMedicamentById($id) {
  $link = conectareBd();
  $query = "SELECT * FROM medicamente WHERE id_medicamente = $id";
  $result = mysqli_query($link, $query);

  if(mysqli_num_rows($result) > 0) {
    return mysqli_fetch_assoc($result);
  } else {
    return null;
  }
}


function updateCantitatePlus($id_medicament) {
  $medicament = getMedicamentById($id_medicament);
  $cantitate = $medicament['cantitate'] + 1;

  if ($cantitate >= 0 && $cantitate <= $medicament['nr_bucati_stoc']) {
    return updateCantitate($id_medicament, $cantitate);
  }

  return false;
}

function updateCantitateMinus($id_medicament) {
  $medicament = getMedicamentById($id_medicament);
  $cantitate = $medicament['cantitate'] - 1;

  if ($cantitate >= 0 && $cantitate <= $medicament['nr_bucati_stoc']) {
    return updateCantitate($id_medicament, $cantitate);
  }

  return false;
}