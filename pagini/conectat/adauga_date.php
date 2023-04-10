
<?php
function validateCNP($cnp) {
     // Afisam valoarea CNP-ului inainte de a fi procesat
  echo "Valoarea CNP-ului este: " . $cnp . "<br>";
  // verificam daca cnp-ul are 13 caractere
  if (strlen($cnp) !== 13) {
    return false;
  }
  
  // verificam daca cnp-ul contine doar cifre
  if (!ctype_digit($cnp)) {
    return false;
  }
  
  // validam cnp-ul folosind algoritmul standard de validare
  $year = intval(substr($cnp, 1, 2));
  $month = intval(substr($cnp, 3, 2));
  $day = intval(substr($cnp, 5, 2));
  $countyCode = intval(substr($cnp, 7, 2));
  $orderNumber = intval(substr($cnp, 9, 3));
  $checkDigit = intval(substr($cnp, 12, 1));
  
  if ($month > 12) {
    return false;
  }
  
  $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
  
  if ($day > $daysInMonth) {
    return false;
  }
  
  $cnpArray = str_split($cnp);
  $weights = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
  $sum = 0;
  
  for ($i = 0; $i < 12; $i++) {
    $sum += $cnpArray[$i] * $weights[$i];
  }
  
  $remainder = $sum % 11;
  
  if ($remainder === 10) {
    $remainder = 1;
  }
  
  if ($remainder !== $checkDigit) {
    return false;
  }
  
  return true;
}
?>


<h1>Mai jos este sectiunea specializata pentru introducerea datelor personale</h1>
<form method="post">
    <table>
        <tr>
            <td>Nume</td>
            <td>
                <input type="text" name="nume_nume" required/>
            </td>
        </tr>
        <tr>
            <td>Prenume</td>
            <td>
                <input type="text" name="Prenume" required/>
            </td>
        </tr>
         <tr>
            <td>CNP</td>
            <td>
                <input type="text" name="CNP" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
         </tr><!-- comment -->
          <tr>
            <td>Telefon</td>
            <td>
                <input type="text" name="telefon" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
        </tr>
         <tr>
            <td>Adresa</td>
            <td>
                <input type="text" name="Adresa" required/>
            </td>
        </tr>
         <tr>
            <td>Varsta</td>
            <td>
                <input type="text" name="Varsta" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="submit" name="salveaza_date" value="Salveaza date"/>
            </th>
        </tr>
    </table>
</form>


<?php

if(isset($_POST['salveaza_date'])){
    $nume = $_POST['nume_nume'];
    $prenume = $_POST['Prenume'];
     $cnp = $_POST['CNP'];
    if (!validateCNP($cnp)) {
    $error = "CNP-ul introdus nu este valid!";
  } else {
    // procesam formularul aici
  }

    $telefon = $_POST['telefon'];
     $adresa = $_POST['Adresa'];
    $varsta = $_POST['Varsta'];
  
    
    
    
    $user = preiaUtilizatorDupaEmail($_SESSION['email']);
        $rezultat = adaugadate($nume, $prenume, $cnp,$telefon,$adresa,$varsta);
        
        if($rezultat){
            print ' Date adaugate cu succes';
        } else{
                print 'eroare la adaugare ';
                
            }
            
        }
        
        