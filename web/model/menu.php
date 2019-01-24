<?php
function getMenuItems() {
    include 'connection.php';
    $query = "SELECT * FROM menu ORDER BY id ASC";   
    $result = pg_exec($db_connection, $query);   
    if ($result) {              
        for ($row = 0; $row < pg_numrows($result); $row++) { 
            $array["id"] = pg_result($result, $row, 'id');
            $array["title"] = pg_result($result, $row, 'title');        
            $array["link"] = pg_result($result, $row, 'link');        
            $array["parent"] = pg_result($result, $row, 'parent_menu');        
            $dbResults[] = $array;
        }        
//    var_dump($array);
//    var_dump($dbResults);
    } else {        
        echo "The query failed with the following error:<br>n";        
        echo pg_errormessage($db_handle);        
    }    
    pg_close($db_handle);
    
    return $dbResults;
}
?>