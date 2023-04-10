<br><br>
<div id="continut">
  <?php
  $informatie = preiadate();
  ?>
  <article class="articol">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nume</th>
          <th>Prenume</th>
          <th>CNP</th>
          <th>Telefon</th>
          <th>Adresă</th>
          <th>Vârstă</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($informatie as $date_personale) { ?>
          <tr>
            <td><?php print $date_personale['id'];?></td>
            <td><?php print $date_personale['nume'];?></td>
            <td><?php print $date_personale['prenume'];?></td>
            <td><?php print $date_personale['cnp'];?></td>
            <td><?php print $date_personale['telefon'];?></td>
            <td><?php print $date_personale['adresa'];?></td>
            <td><?php print $date_personale['varsta'];?></td>
            <td><a href="index.php?page=2&id_stergere=<?php print $date_personale['id'];?>">Șterge</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </article>
</div>
        <style>      table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}
</style>
<Br><br>
<form method="POST">
  Nume pacient: <input type="text" name="modificanumele"><br>
  ID pacient: <input type="text" name="idpacient"><br>
  <input type="submit" name="modificanume" value="Modifica nume">
</form>

<?php  
    
if(isset($_POST['modificanume'])){
  $nume = $_POST['modificanumele'];
  $idpacient = $_POST['idpacient'];

  $rezultat = updatenumelepacientului2($nume, $idpacient);
  header("location: index.php?page=2");

  if($rezultat){
    print 'modificare realizata';
  } else{
    print 'eroare';
  }
}






if(isset($_GET['id_stergere'])){
    $idul =$_GET['id_stergere'];
    $sters = stergepacientul($idul);
    
   header("location: index.php?page=2");//e refresh la pagina asta
       if($sters){
       
       
       print ' modificare realizata';}
         else{
                print 'eroare  ';
    
}}
?>
<br><!-- comment -->
 <br> 
 <br><!-- comment -->
 <br>
 </div>