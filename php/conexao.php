<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definir o conjunto de caracteres como UTF-8
$conn->set_charset("utf8mb4");
?>
