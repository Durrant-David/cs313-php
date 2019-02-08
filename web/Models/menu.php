<?php
function getMenuItems() {
    include 'connection.php';
    $result = $db->query("SELECT * FROM menu ORDER BY id ASC");   
    $result->execute();
    //$result = pg_exec($db_connection, $query);   
    if ($result) {             
        foreach($result->fetchAll() as $row) {  
            $array["id"] = $row['id'];
            $array["title"] = $row['title'];        
            $array["link"] = $row['link'];        
            $array["parent"] = $row['parent_menu'];        
            $dbResults[] = $array;
        }        
//    var_dump($array);
//    var_dump($dbResults);
    } else {        
        echo "The query failed with the following error:<br>n";        
        echo pg_errormessage($db_handle);        
    }    
    //pg_close($db_handle);
    
    return $dbResults;
}
?>