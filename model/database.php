<?php
    //define permet d'utiliser dans tous mes fichiers c'est , c'est une constante qui ne cahnge pas 
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "gaming");

    // Create connection
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    }
    //echo "Connected successfully";
    return $db;