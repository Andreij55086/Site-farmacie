<?php  
 //fetch.php  
 
 $rezultatInregistrare = inregistrare($email, $parola,$nume,$prenume,$cnp,$telefon,$adresa,$varsta);
 if(isset($_POST["id"]))  
 {  
      $output = array();  
      $procedure = "  
      CREATE PROCEDURE whereUser(IN medicamente int(11))  
      BEGIN   
      SELECT * FROM medicamente WHERE id = id_medicamente;  
      END;   
      ";  
      if(mysqli_query($rezultatInregistrare, "DROP PROCEDURE IF EXISTS whereUser"))  
      {  
           if(mysqli_query($rezultatInregistrare, $procedure))  
           {  
                $query = "CALL whereUser(".$_POST["id"].")";  
                $result = mysqli_query($rezultatInregistrare, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     $output['first_name'] = $row["first_name"];  
                     $output['last_name'] = $row["last_name"];  
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  