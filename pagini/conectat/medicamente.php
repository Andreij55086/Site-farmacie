<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exemplu</title>
    <!-- Biblioteca Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    
    <!-- Biblioteca Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>

    <h1>Mai jos este sectiunea specializata pentru introducerea medicamentelor</h1>
    <form method="post">
      <div class="bootstrap-container">
        <table>
          <tr>
            <td>Denumire</td>
            <td>
              <input type="text" name="denumire" required/>
            </td>
          </tr>
          <tr>
            <td>Gramaj</td>
            <td>
              <input type="text" name="gramaj" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
          </tr>
          <tr>
  <td>Forma pastilelor</td>
  <td>
    <select name="forma" required>
      <option value="">Selecteaza forma</option>
      <option value="Rotunda">Rotunda</option>
      <option value="Patrata">Patrata</option>
      <option value="Ovala">Ovala</option>
    </select>
  </td>
</tr>
          <tr>
            <td>Descriere</td>
            <td>
              <input type="text" name="descriere" required/>
            </td>
          </tr>
          <tr>
            <td>Lot</td>
            <td>
              <input type="text" name="lot" required/>
            </td>
          </tr>
          <tr>
            <td>Data expirare</td>
            <td>
              <div class="input-group date">
                <input type="text" class="datepicker" name="data_expirare">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
                </span>
              </div>
            </td>
          </tr>
          <tr>
            <td>Numar bucati in stoc</td>
            <td>
              <input type="text" name="nrbucati" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
          </tr>
           <tr>
            <td>Pret</td>
            <td>
              <input type="text" name="pret" pattern="[0-9]*" title="Introduceti doar cifre" required />
            </td>
          </tr>
          <tr>
            <th colspan="2">
              <input type="submit" name="salveaza_date" value="Salveaza date"/>
            </th>
          </tr>
        </table>
      </div>
    </form>

    <!-- Biblioteca jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Biblioteca Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(document).ready(function(){
        // Modificarea selectorului pentru a selecta datepicker-urile doar din containerul Bootstrap
        $('.bootstrap-container .datepicker').datepicker();
      });
    </script>
<?php

if(isset($_POST['salveaza_date'])){
    $denumire = $_POST['denumire'];
    $gramaj = $_POST['gramaj'];
     $forma = $_POST['forma'];
    $descriere = $_POST['descriere'];
     $lot = $_POST['lot'];
    $dataexp = date("Y-m-d", strtotime($_POST['data_expirare']));
  $stoc = $_POST['nrbucati'];
  $pret = $_POST['pret'];
    //$user = preiaUtilizatorDupaEmail($_SESSION['email']);
        $rezultat = adaugamedicamente($denumire, $gramaj, $forma,$descriere,$lot,$dataexp,$stoc,$pret);
        
        if($rezultat){
            print ' Date adaugate cu succes';
        } else{
                print 'eroare la adaugare ';
                
            }
            
        }
        
        ?>

</html>