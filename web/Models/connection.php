<?php
//    $db_connection = pg_connect("host=ec2-54-235-77-0.compute-1.amazonaws.com dbname=dfnsbg9852d9sd user=yeviieqbnducom password=cc35265ef770f913fd0ff27a97e613d7d83e75c124786ead7bdac56272a41936");
?>
<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

//print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

try {
 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}


?>
