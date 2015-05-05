<?php
require_once("/resources/library/MysqliDb.php");
require_once("/resources/config.php");

$servername = $config["db"]["host"];
$username = $config["db"]["username"];
$password = $config["db"]["password"];
$dbname = $config["db"]["dbname"];

$db = new Mysqlidb ($servername, $username, $password, $dbname);

function getPrice ($product, $parameter){
    global $db;
    
    $db->where ("Product", $product);
    $db->where ("Parameter", $parameter);
    $priceFromDb = $db->getOne ("prices");
    
    return $priceFromDb["Value"];
}

function getWindowPrice ($parameter){
    return getPrice(Products::Window, $parameter);
}

function getDoorPrice ($parameter){
    return getPrice(Products::Door, $parameter);
}

function getStairsPrice ($parameter){
    return getPrice(Products::Stairs, $parameter);
}

?>
