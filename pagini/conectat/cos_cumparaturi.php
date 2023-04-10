


<br>
<strong>Sunteti in cosul de cumparaturi</strong>
<br><br>
<?php
$medicamente = preiaMedicamente();
?>

<table>
  <thead>
    <tr>
      <th>ID medicament</th>
      <th>Denumire</th>
      <th>Gramaj</th>
      <th>Forma</th>
      <th>Descriere</th>
      <th>Lot</th>
      <th>Data expirare</th>
      <th>Cantitate</th>     
      <th>Pret</th>
    </tr>
  </thead>
  <tbody>

<?php 
$pret_final = 0; // inițializăm variabila cu valoarea 0
foreach ($medicamente as $medicament) {
    if ($medicament['cantitate'] > 0) {
        // verificăm dacă variabila $_POST['cantitate'] există și are o valoare validă
        $cantitate = isset($_POST['cantitate']) ? intval($_POST['cantitate']) : 0;
        // filtrăm variabila $cantitate pentru a evita vulnerabilitățile de tip SQL injection sau XSS
        $cantitate = filter_var($cantitate, FILTER_SANITIZE_NUMBER_INT);
        echo "Cantitate:".$medicament['cantitate']."<br>";
        $pret_final += $medicament['cantitate']* $medicament['pret'];
        ?>
        <tr>
          <td><?php print $medicament['id_medicamente']; ?></td>
          <td><?php print $medicament['denumire']; ?></td>
          <td><?php print $medicament['gramaj']; ?></td>
          <td><?php print $medicament['forma']; ?></td>
          <td><?php print $medicament['descriere']; ?></td>
          <td><?php print $medicament['lot']; ?></td>
          <td><?php print $medicament['data_expirare']; ?></td>
<td>
  <form method="POST">
    <input type="hidden" name="id_medicament" value="<?php echo $medicament['id_medicamente']; ?>">
    <button type="submit" name="minus" value="-">-</button>
    <?php 
      if (isset($_POST['minus']) && $_POST['minus'] === '-' && $medicament['cantitate'] > 0) {
        $medicament['cantitate']--;
      } elseif (isset($_POST['plus']) && $_POST['plus'] === '+') {
        $medicament['cantitate']++;
      }
      echo $medicament['cantitate'];
    ?>
    <button type="submit" name="plus" value="+">+</button>
  </form>
</td>
          <td><?php print $medicament['pret']; ?></td>
          <td>
            <a href="index.php?page=4&id_stergere=<?php print $medicament['id_medicamente']; ?>">Sterge</a>
          </td>
        </tr>
    <?php 
    }
} 
?>
</tbody>
</table>
<?php 
echo 'Pretul total este: ' . $pret_final;
?>


<?php
// pentru adăugarea cantității
if (isset($_POST['plus']) && $_POST['plus'] === '+') {
  $id_medicament = $_POST['id_medicament'];
  $medicament = getMedicamentById($id_medicament);

  $cantitate = $medicament['cantitate'] + 1;

  if ($cantitate >= 0 && $cantitate <= $medicament['nr_bucati_stoc']) {
    updateCantitatePlus($id_medicament, $cantitate);
  }
}

// pentru scăderea cantității
if (isset($_POST['minus']) && $_POST['minus'] === '-') {
  $id_medicament = $_POST['id_medicament'];
  $medicament = getMedicamentById($id_medicament);

  $cantitate = $medicament['cantitate'] - 1;

  if ($cantitate >= 0 && $cantitate <= $medicament['nr_bucati_stoc']) {
    updateCantitateMinus($id_medicament, $cantitate);
  }
}
?>



<form method="POST">
  <input type="submit" name="plaseaza" value="Plaseaza comanda">
</form>
<?php
if(isset($_POST['plaseaza'])){
  


  
  foreach ($medicamente as $medicament) {
    $id_medicament = $medicament['id_medicamente'];
    $disponibilitate = $medicament['nr_bucati_stoc'] - $medicament['cantitate'];
    
    if($disponibilitate >= 0){
    $cantitateFinala = updateCantitateFinala($id_medicament, $disponibilitate);
 header("location: index.php?page=5");
      echo 'Comanda plasata';
      exit(); // opreste executia scriptului
    } else{
      echo 'Nu exista suficienta cantitate in stoc pentru medicamentul: ' . $medicament['denumire'] . '<br>';
    }
  }
}

?>
