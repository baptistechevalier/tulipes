<?php
$db="tulipe";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="root";

$pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
$pdo->exec("SET CHARACTER SET utf8");