<?php  
 //action.php  
 if(isset($_POST["action"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "farmacie");  
  
      if($_POST["action"] == "Edit")  
      {  
              $nume = $_POST['denumire'];
              $prenume = $_POST['Prenume'];
           $procedure = "  
                  
                UPDATE medicamente SET first_name = firstName, last_name = lastName  
                WHERE id = user_id;  
                END;   
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL updateUser('".$_POST["id"]."', '".$first_name."', '".$last_name."')";  
                     mysqli_query($connect, $query);  
                     echo 'Data Updated';  
                }  
           }  
      }  
      if($_POST["action"] == "Delete")  
      {  
           $procedure = "  
           CREATE PROCEDURE deleteUser(IN user_id int(11))  
           BEGIN   
           DELETE FROM users WHERE id = user_id;  
           END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL deleteUser('".$_POST["id"]."')";  
                     mysqli_query($connect, $query);  
                     echo 'Data Deleted';  
                }  
           }  
      }  
 }  
 ?> 