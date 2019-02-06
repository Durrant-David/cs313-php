<?php
function getProducts() {
    include 'connection.php';
    $result = $db->query("SELECT * FROM products");   
    //$result = pg_exec($db_connection, $query);   
    if ($result) {              
        foreach($result->fetchAll() as $row) { 
            $array["id"] = $row['id'];
            $array["product"] = $row['product'];        
            $array["quantity"] = $row['quantity'];        
            $array["img"] = $row['img'];          
            $array["price"] = $row['price'];      
            $array["description"] = $row['description'];        
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

function updateProduct($data, $cond) {
    include 'connection.php';
    $res = pg_update($db_connection, 'products', $data, $cond);
    if (!$res) {
        throw new Exception(DB_ERR . 'Update: ' . pg_last_error($this->conn));
    }
    return $res;
}
?>