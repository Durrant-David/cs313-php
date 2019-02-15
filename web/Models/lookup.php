<?php
defined('_CSEXEC') or die;
    class LookupModel
    {
        function __construct()
        {

        }

        public function getFilterItems($filter) {
            $result = $GLOBALS['db']->query('SELECT name FROM lookup_' . strtolower($filter));
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

        public function getStatusItems() {
            $result = $GLOBALS['db']->query("SELECT name FROM fixture_status");   
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

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.number, s.name sn
                FROM lookup l 
                LEFT JOIN lookup_type ty ON l.lookup_type_id = ty.id
                LEFT JOIN lookup_level le ON l.lookup_level_id = le.id
                LEFT JOIN lookup_catwalk cat ON l.lookup_catwalk_id = cat.id
				LEFT JOIN lookup_chair ch ON l.lookup_chair_id = ch.id
				LEFT JOIN lookup_position pos ON l.lookup_position_id = pos.id
                LEFT JOIN fixture f ON l.fixture_id = f.id
                LEFT JOIN fixture_status s on f.fixture_status_id = s.id
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

        public function getLookupItem($id) {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.number, s.name sn
                FROM lookup l 
                LEFT JOIN lookup_type ty ON l.lookup_type_id = ty.id
                LEFT JOIN lookup_level le ON l.lookup_level_id = le.id
                LEFT JOIN lookup_catwalk cat ON l.lookup_catwalk_id = cat.id
				LEFT JOIN lookup_chair ch ON l.lookup_chair_id = ch.id
				LEFT JOIN lookup_position pos ON l.lookup_position_id = pos.id
                LEFT JOIN fixture f ON l.fixture_id = f.id
                LEFT JOIN fixture_status s on f.fixture_status_id = s.id
                WHERE l.id='$id'
                ");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["type"] = $row['tyn'];        
                    $array["level"] = $row['len'];        
                    $array["catwalk"] = $row['catn'];
                    $array["chair"] = $row['chn'];
                    $array["position"] = $row['pn'];
                    $array["status"] = $row['sn'];
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getFixtureList() {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT f.id, l.name as cw, f.number as num
                FROM fixture f 
                LEFT JOIN lookup_catwalk l ON l.id = f.lookup_catwalk_id
                ");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];        
                    $array["catwalk"] = $row['cw'];
                    $array["number"] = $row['num'];
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