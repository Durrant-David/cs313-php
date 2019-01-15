<?php
    include 'connection.php';
    $query = "SELECT * FROM menu";   
    $result = pg_exec($db_handle, $query);   
    echo "Number of rows: " . pg_numrows($result);   
    pg_freeresult($result);   
    pg_close($db_handle); 
?>