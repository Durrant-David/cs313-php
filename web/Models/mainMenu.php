<?php
defined('_CSEXEC') or die;
    class MainMenuModel
    {


        function __construct()
        {

        }
        
        public function getMenuItems() {
            $result = $GLOBALS['db']->query("SELECT id, title, link, parent_menu FROM menu ORDER BY id ASC");   
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
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

    }
?>