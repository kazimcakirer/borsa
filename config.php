<?php

define("URL", "http://localhost/projects/borsa/");

$api = "http://localhost/projects/borsa/api.php";
$bot = 'http://localhost/projects/borsa/bot.php';
$host = "localhost";
$user = "root";
$password = "";


$interval = ["haftalik", "aylik", "3 aylik", "6 aylik", "12 aylik"];
$shareType = ["TUM", "100", "50", "30", "YILDIZ", "ALT"];

$databaseName = "mydb";
$tableName = 'hisse';

$columnName = [
    "id",
    "share",
    "update_share"
];
