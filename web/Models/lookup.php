<?php
defined('_CSEXEC') or die;
    class LookupModel
    {

        private $message = 'Welcome to Home page.';

        function __construct()
        {

        }

        public function getTypeItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM lookup_type");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                $dbResults = $result;
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getLevelItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM lookup_level");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                $dbResults = $result;
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getCatwalkItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM lookup_catwalk");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                $dbResults = $result;
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getChairItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM lookup_chair");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                $dbResults = $result;
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getPositionItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM lookup_position");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                $dbResults = $result;
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getList($filters = "", $order = "l.id ASC") {

            $result = $GLOBALS['db']->query(
                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.number, s.name sn
                FROM lookup l 
                INNER JOIN lookup_type ty ON l.lookup_type_id = ty.id
                INNER JOIN lookup_level le ON l.lookup_level_id = le.id
                INNER JOIN lookup_catwalk cat ON l.lookup_catwalk_id = cat.id
				INNER JOIN lookup_chair ch ON l.lookup_chair_id = ch.id
				INNER JOIN lookup_position pos ON l.lookup_position_id = pos.id
                INNER JOIN fixture f ON l.fixture_id = f.id
                INNER JOIN fixture_status s on f.fixture_status_id = s.id
                $filters
                ORDER BY $order;
                ");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["type"] = $row['tyn'];        
                    $array["level"] = $row['len'];        
                    $array["catwalk"] = $row['catn'];
                    $array["number"] = $row['number'];
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