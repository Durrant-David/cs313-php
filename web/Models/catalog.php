<?php
defined('_CSEXEC') or die;
    class CatalogModel
    {

        function __construct()
        {

        }

        public function getCategory() {
            
            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT id, name, parent_category_id FROM catalog_category");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["name"] = $row['name'];        
                    $array["parent"] = $row['parent_category_id'];        
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getCatalogByCategory($category) {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT log.id logid, log.name as logn, log.location as logl, log.image as logi, log.description as logd, cat.name as catn, s.name as sn
                FROM catalog log 
                INNER JOIN catalog_category cat ON log.catalog_category_id = cat.id
                INNER JOIN catalog_status s ON log.catalog_status_id = s.id
                WHERE cat.name = '" . $category . "'");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['logid'];
                    $array["name"] = $row['logn'];        
                    $array["location"] = $row['logl'];        
                    $array["image"] = $row['logi'];
                    $array["description"] = $row['logd'];
                    $array["category"] = $row['catn'];
                    $array["status"] = $row['sn'];
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