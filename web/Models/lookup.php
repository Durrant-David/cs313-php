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
                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.number, s.name as sn
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
//            $result = $GLOBALS['db']->query(
//                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.number, s.name as sn
//                FROM lookup l 
//                LEFT JOIN lookup_type ty ON l.lookup_type_id = ty.id
//                LEFT JOIN lookup_level le ON l.lookup_level_id = le.id
//                LEFT JOIN lookup_catwalk cat ON l.lookup_catwalk_id = cat.id
//				LEFT JOIN lookup_chair ch ON l.lookup_chair_id = ch.id
//				LEFT JOIN lookup_position pos ON l.lookup_position_id = pos.id
//                LEFT JOIN fixture f ON l.fixture_id = f.id
//                LEFT JOIN fixture_status s on f.fixture_status_id = s.id
//                $filters
//                ORDER BY $order;
//                ");   
            $result->execute();
//            $result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];
                    $array["type"] = $row['tyn'];        
//                    $array["level"] = $row['len'];        
//                    $array["catwalk"] = $row['catn'];
//                    $array["number"] = $row['fpn'];
//                    $array["status"] = $row['sn'];
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
                "SELECT l.id, ty.name as tyn, le.name as len, cat.name as catn, ch.name as chn, pos.name as pn, f.id as fid, f.number as num, s.name as sn
                FROM lookup l 
                LEFT JOIN lookup_type ty ON l.lookup_type_id = ty.id
                LEFT JOIN lookup_level le ON l.lookup_level_id = le.id
                LEFT JOIN lookup_catwalk cat ON l.lookup_catwalk_id = cat.id
				LEFT JOIN lookup_chair ch ON l.lookup_chair_id = ch.id
				LEFT JOIN lookup_position pos ON l.lookup_position_id = pos.id
                LEFT JOIN fixture f ON l.fixture_id = f.id
                LEFT JOIN fixture_status s ON f.fixture_status_id = s.id
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
                    $array["fixture_id"] = $row['fid'];
                    $array["number"] = $row['num'];
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function setLookupItem($values) {
            try {
                $query = "UPDATE lookup 
                    SET lookup_type_id=:type, 
                    lookup_level_id=:level, 
                    lookup_catwalk_id=:catwalk, 
                    lookup_chair_id=:chair, 
                    lookup_position_id=:position, 
                    fixture_id=:fixture
                    WHERE id=:id";

                $statement = $GLOBALS['db']->prepare($query);

                $statement->bindValue(':id', $values["id"]);
                $statement->bindValue(':type', $values["type"]);
                $statement->bindValue(':level', $values["level"]);
                $statement->bindValue(':catwalk', $values["catwalk"]);
                $statement->bindValue(':chair', $values["chair"]);
                $statement->bindValue(':position', $values["position"]);
                $statement->bindValue(':fixture', $values["fixture"]);
                $statement->execute();
            }
            catch (Exception $ex)
            {

                echo "Error with DB.";
                die();
            }

        }

        public function getItemId($table, $name) {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT id FROM lookup_$table WHERE name='$name'");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $dbResults = $row['id'];
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getStatusId($name) {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT id FROM fixture_status WHERE name='$name'");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $dbResults[] = $row['id'];
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
                "SELECT f.id, ty.name as tyn, lvl.name as lvln, cw.name as cwn, fp.name as fpn
                FROM fixture f 
                LEFT JOIN lookup_type ty ON ty.id = f.lookup_type_id
                LEFT JOIN lookup_level lvl ON lvl.id = f.lookup_level_id
                LEFT JOIN lookup_catwalk cw ON cw.id = f.lookup_catwalk_id
                LEFT JOIN fixture_position fp ON fp.id = f.fixture_position_id
                ");   
            $result->execute();
            //$result = pg_exec($db_connection, $query);   
            if ($result) {             
                foreach($result->fetchAll() as $row) {  
                    $array["id"] = $row['id'];        
                    $array["type"] = $row['tyn'];
                    $array["level"] = $row['lvln'];
                    $array["catwalk"] = $row['cwn'];
                    $array["number"] = $row['fpn'];
                    $dbResults[] = $array;
                }        
            } else {        
                echo "The query failed with the following error:<br>n";        
                echo pg_errormessage($db_handle);        
            }    

            return $dbResults;
        }

        public function getFixtureItem($id) {

            $dbResults = array();
            $result = $GLOBALS['db']->query(
                "SELECT f.id, l.name as cw, f.number as num
                FROM fixture f 
                LEFT JOIN lookup_catwalk l ON l.id = f.lookup_catwalk_id
                WHERE f.id='$id'
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

        public function setStatus($id, $status) {
            $statusId = $this->getStatusId($status);
            try {
                    $query = "UPDATE fixture
                                SET fixture_status_id = :status
                                FROM lookup
                                WHERE lookup.fixture_id = fixture.id 
                                AND lookup.id = :lookup";

                    $statement = $GLOBALS['db']->prepare($query);

                    $statement->bindValue(':status', $statusId[0]);
                    $statement->bindValue(':lookup', $id);
                    $statement->execute();
                }
                catch (Exception $ex)
                {

                    echo "Error with DB.";
                    die();
                }

        }
    }
?>
