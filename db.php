<?php
define("DBHOST", "localhost");
define("DBDB",   "demo");
define("DBUSER", "lamp1user");
define("DBPW", "!Lamp12!");

function connectDB(){
    $dsn = "mysql:host=".DBHOST.";dbname=".DBDB.";charset=utf8";
    try{
        $dbc = new PDO($dsn, DBUSER, DBPW);
        return $dbc;
    } catch (PDOException $e){
        echo "<p>Error opening database <br/>\n".$e->getMessage()."</p>\n";
        exit(1);
    }
}
?>