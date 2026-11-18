<?php
$dns = "mysql:host=127.0.0.1;dbname=sites_favoritos_db;charset=utf8mb4";
$user= "root";
$pass= "";

try {
    $conexao = new PDO($dns, $user, $pass);
    
} catch (PDOException $erro) {
    echo("Entre em contato com suporte!");
}