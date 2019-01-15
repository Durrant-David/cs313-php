<?php
    include 'connection.php';
    $query = "SELECT * FROM menu";   
    $result = pg_exec($db_connection, $query);   
    if ($result) {        
        echo "The query executed successfully.<br>n";        
        for ($row = 0; $row < pg_numrows($result); $row++) { 
            $id = pg_result($result, $row, 'id');
            $title = pg_result($result, $row, 'title');        
            $link = pg_result($result, $row, 'link');        
            $parent = pg_result($result, $row, 'parent_menu');        
            echo "menu: $id<br>n";    
            echo "menu: $title<br>n";    
            echo "menu: $link<br>n";    
            echo "menu: $paremt<br>n";        
        }        
    } else {        
        echo "The query failed with the following error:<br>n";        
        echo pg_errormessage($db_handle);        
    }    
    pg_close($db_handle); 
?>