<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Denumire</th>
      <th>Gramaj</th>
      <th>Forma</th>
      <th>Descriere</th>
      <th>Lot</th>
      <th>Data expirare</th>
      <th>Număr bucăți în stoc</th>
      <th>Pret</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $medicamente = preiamedicamente();
foreach ($medicamente as $medicament){
    //if($medicament['cantitate']>0) {
        ?>
        <tr>
            <td><?php print $medicament['id_medicamente'];?></td>
            <td><?php print $medicament['denumire'];?></td>
            <td><?php print $medicament['gramaj'];?></td>
            <td><?php print $medicament['forma'];?></td>
            <td><?php print $medicament['descriere'];?></td>
            <td><?php print $medicament['lot'];?></td>
            <td><?php print $medicament['data_expirare'];?></td>
            <td><?php print $medicament['nr_bucati_stoc'];?></td>
            <td><?php print $medicament['pret'];?></td>
            <td><a href="index.php?page=4&id_stergere=<?php print $medicament['id_medicamente'];?>">Șterge</a></td>
            <td><a href="index.php?page=4&id_cumparare=<?php print $medicament['id_medicamente'];?>">Cumpără</a></td>
        </tr>
        <?php 
    } 
  ?>
  </tbody>
</table>
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
<form method="POST">
  Id ul medicamentului: <input type="text" name="idmedicament"><br>
  Nume nou: <input type="text" name="numenou"><br>
  pentru ce coloana se aplica numele nou:
  <ol>
    <li><label><input type="checkbox" name="coloana" value="Denumire">Denumire</label></li>
    <li><label><input type="checkbox" name="coloana" value="Gramaj">Gramaj</label></li>
    <li><label><input type="checkbox" name="coloana" value="Forma">Forma</label></li>
    <li><label><input type="checkbox" name="coloana" value="Descriere">Descriere</label></li><!-- comment -->
    <li><label><input type="checkbox" name="coloana" value="data_expirare">Data expirare</label></li>
    <li><label><input type="checkbox" name="coloana" value="nr_bucati_stoc">Stoc disponibil</label></li>
    <li><label><input type="checkbox" name="coloana" value="Lot">Lot</label></li>
     <li><label><input type="checkbox" name="coloana" value="Pret">Pret</label></li>
  </ol>
  <input type="submit" name="modificanume" value="Modifica nume">
</form>

<?php
if(isset($_POST['modificanume'])){
  $idmedicament = $_POST['idmedicament'];
  $numenou = $_POST['numenou'];
  $coloana = $_POST['coloana'];

  // Verificăm dacă $coloana este setat și conține o valoare validă
  if(isset($coloana) && in_array($coloana, array("Denumire", "Gramaj", "Forma","Descriere","data_expirare","nr_bucati_stoc","Lot","Pret"))){
    $rezultat = updatetest($idmedicament, $numenou, $coloana);

    if($rezultat){
      header("location: index.php?page=4");
      exit();
    } else{
      print 'eroare';
    }
  } else {
    print 'Trebuie selectată o coloană validă.';
  }
}



if(isset($_GET['id_stergere'])){
    $idul =$_GET['id_stergere'];
    $sters = stergemedicamentul($idul);
    
   header("location: index.php?page=4");//e refresh la pagina asta
       if($sters){
       
       
       print ' modificare realizata';}
         else{
                print 'eroare  ';
    
}}

if(isset($_GET['id_cumparare'])){
    $idul2 =$_GET['id_cumparare'];
    $updatenumarstoc = updatestoc($idul2);
    $updatecantitate = updatecantitate($idul2);
   header("location: index.php?page=4");//e refresh la pagina asta
   die();
       if($updatenumarstoc && $updatecantitate){
       
       
       print ' modificare realizata';}
         else{
                print 'eroare  ';
    
}}
?>