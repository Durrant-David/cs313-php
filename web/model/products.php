<?php
function getProducts() {
    include 'connection.php';
    $query = "SELECT * FROM products";   
    $result = pg_exec($db_connection, $query);   
    if ($result) {              
        for ($row = 0; $row < pg_numrows($result); $row++) { 
            $array["id"] = pg_result($result, $row, 'id');
            $array["product"] = pg_result($result, $row, 'product');        
            $array["quantity"] = pg_result($result, $row, 'quantity');        
            $array["img"] = pg_result($result, $row, 'img');          
            $array["price"] = pg_result($result, $row, 'price');      
            $array["description"] = pg_result($result, $row, 'description');        
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