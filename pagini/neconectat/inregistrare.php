<h1>Inregistrare</h1>
<form method="post">
    <table>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" name="email_utilizator" required/>
            </td>
        </tr>
        <tr>
            <td>Parola</td>
            <td>
                <input type="password" name="pass" required/>
            </td>
        </tr>
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
                <input type="text" name="CNP" required/>
            </td>
         </tr><!-- comment -->
          <tr>
            <td>Telefon</td>
            <td>
                <input type="text" name="telefon" required/>
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
                <input type="text" name="Varsta" />
            </td>
        </tr>

        <tr>
            <th colspan="2">
                <input type="submit" name="inregistrare" value="Inregistrare"/>
            </th>
        </tr>
    </table>
</form>
<?php 
if (isset($_POST['inregistrare'])) {
    $email = $_POST['email_utilizator'];
    $parola = $_POST['pass'];
    $nume = $_POST['nume_nume'];
    $prenume = $_POST['Prenume'];
     $cnp = $_POST['CNP'];
     function validate_cnp($cnp) {
    if (strlen($cnp) != 13 || !is_numeric($cnp)) {
        return false;
    }
    $year = intval(substr($cnp, 1, 2));
    $month = intval(substr($cnp, 3, 2));
    $day = intval(substr($cnp, 5, 2));
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31) {
        return false;
    }
    if (in_array($month, array(4, 6, 9, 11)) && $day > 30) {
        return false;
    }
    if ($month == 2) {
        $leapYear = ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0));
        if (($leapYear && $day > 29) || (!$leapYear && $day > 28)) {
            return false;
        }
    }
    $countyCode = intval(substr($cnp, 7, 2));
    if ($countyCode < 1 || $countyCode > 52) {
        return false;
    }
return true;
}



     if (validate_cnp($cnp)) {
    echo "CNP-ul este valid.";
} else {
    echo "CNP-ul este invalid.";
}
  $telefon = $_POST['telefon'];

function validate_phone_number($telefon) {
    // Inlocuim toate caracterele care nu sunt cifre cu un sir vid
    $telefon = preg_replace('/[^0-9]/', '', $telefon);

    // Verificam daca numarul are lungimea potrivita pentru un numar de telefon
    if (strlen($telefon) != 10) {
        return false;
    }

    // Daca numarul are 10 cifre, prima cifra trebuie sa fie 0 si a doua 7
    if (substr($telefon, 0, 1) != '0' || substr($telefon, 1, 1) != '7') {
        return false;
    }

    // Numarul pare sa fie valid
    return true;
}

if (validate_phone_number($telefon)) {
    echo "Numarul este de Romania.";
} else {
    echo "Numarul nu este de Romania.";
}



     $adresa = $_POST['Adresa'];
    $varsta = $_POST['Varsta'];
    if (trim($email) == null || trim($parola) == null || trim($nume) == null || trim($prenume) == null||trim($cnp) == null || trim($telefon) == null || trim($adresa) == null) {
        print 'Emailul, parola,numele,prenumele,cnp ul ,telefonul si adresa  nu pot fi nule!';
        return;
    }
    $rezultatInregistrare = inregistrare($email, $parola,$nume,$prenume,$cnp,$telefon,$adresa,$varsta);
    if ($rezultatInregistrare) {
        $_SESSION['email'] = $email; //autologin la inregistrare cu succes
        $_SESSION['welcome'] = "Salut, $email, te-ai inregistrat cu succes!";
        header("location: index.php");
    } else {
        print 'Eroare la inregistrare';
    }
}