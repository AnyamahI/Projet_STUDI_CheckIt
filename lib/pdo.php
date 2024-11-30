<?php
try
{
$pdo = new PDO("mysql:dbname=projet_studi_checkit;host=localhost;charset=utf8mb4;port=3307", "root", "");
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
?>