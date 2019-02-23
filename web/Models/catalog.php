<?php
defined('_CSEXEC') or die;
    class CatalogModel
    {

        function __construct()
        {

        }

        public function getCategoriesParentSort() {
            $dbResults = array();
            $query = "WITH RECURSIVE subcategories AS
                      (
                        SELECT id, name, parent_category_id,
                        ROW_NUMBER() OVER (ORDER BY id) AS rownum,
                        0 AS levelnum
                        FROM catalog_category
                        WHERE parent_category_id IS NULL 
                        UNION
                        SELECT i.id, i.name, i.parent_category_id, rownum, levelnum + 1
                        FROM catalog_category i
                        INNER JOIN subcategories c
                            ON i.parent_category_id = c.id
                      )

                        SELECT id, name, parent_category_id, rownum, levelnum
                        FROM subcategories 
                        ORDER BY rownum ASC, levelnum ASC";  
            $result = $GLOBALS['db']->query($query);
            $result->execute();   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["name"] = $row['name'];        
                    $array["parent"] = $row['parent_category_id'];  
                    $array["row"] = $row['rownum'];   
                    $array["level"] = $row['levelnum'];        
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    
            return $dbResults;
        }

        public function getCategoriesByParent($parent = NULL) {
            $dbResults = array();
            if($parent == null) {
                $query = "SELECT id, name, parent_category_id FROM catalog_category WHERE parent_category_id IS NULL OR parent_category_id = '0'";  
            } else {
                $query = "SELECT id, name, parent_category_id FROM catalog_category WHERE parent_category_id = '$parent'";  
            }
            $result = $GLOBALS['db']->query($query);
            $result->execute();
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

        public function getCategory($category) {
            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT * FROM catalog_category WHERE id = '$category'");   
            $result->execute();
            if ($result) {             
                $dbResults = $result->fetch();
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    
            return $dbResults;
        }
        
        public function getCatalogByCategory($category = NULL) {
            
            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT log.id logid, log.name as logn, log.location as logl, log.image as logi, log.description as logd, cat.name as catn, s.name as sn
                FROM catalog log 
                INNER JOIN catalog_category cat ON log.catalog_category_id = cat.id
                INNER JOIN catalog_status s ON log.catalog_status_id = s.id
                WHERE cat.id = '$category'"); 
            if ($result) {
                $result->execute();  
            }

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
                //echo "The query failed with the following error:<br>n";        
                //echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }
        
        public function getStatusItems() {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT id, name FROM catalog_status");   
            $result->execute();  
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["name"] = $row['name'];
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }
        
        public function insertCategory($values) {
            $result = $GLOBALS['db']->prepare(
                "INSERT INTO catalog_category (name, parent_category_id) VALUES (:name, :category)");
            $result->bindParam(':name', $values['name']);
            $result->bindParam(':category', $values['category']);
            $result->execute();  

            return $GLOBALS['db']->lastInsertId('catalog_category_id_seq');
        }
        
        public function updateCategory($values) {

            $result = $GLOBALS['db']->prepare(
                "UPDATE catalog_category SET name=:name, parent_category_id=:category WHERE id=:id");
            $result->bindParam(':id', $values['id']);
            $result->bindParam(':name', $values['name']);
            $result->bindParam(':category', $values['category']);
            $result->execute();  

        }
        
        public function insertItem($values) {
            $result = $GLOBALS['db']->prepare(
                "INSERT INTO catalog (name, catalog_category_id, location, catalog_status_id, image, description) VALUES (:name, :category, :location, :status, :image, :description)");
            $result->bindParam(':name', $values['name']);
            $result->bindParam(':category', $values['category']);
            $result->bindParam(':location', $values['location']);
            $result->bindParam(':status', $values['status']);
            $result->bindParam(':image', $values['image']);
            $result->bindParam(':description', $values['description']);
            $result->execute();  

            return $GLOBALS['db']->lastInsertId('catalog_id_seq');
        }
        
        public function updateItem($values) {

            $result = $GLOBALS['db']->prepare(
                "UPDATE catalog SET name=:name, catalog_category_id=:category, location=:location, catalog_status_id=:status, image=:image, description=:description WHERE id=:id");
            $result->bindParam(':id', $values['id']);
            $result->bindParam(':name', $values['name']);
            $result->bindParam(':category', $values['category']);
            $result->bindParam(':location', $values['location']);
            $result->bindParam(':status', $values['status']);
            $result->bindParam(':image', $values['image']);
            $result->bindParam(':description', $values['description']);
            $result->execute();  

        }

        public function getItem($id) {
            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT * FROM catalog WHERE id = '$id'");   
            $result->execute();
            if ($result) {             
                $dbResults = $result->fetch();
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    
            return $dbResults;
        }
    }
?>