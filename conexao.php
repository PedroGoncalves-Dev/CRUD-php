<?php
// Informações de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root"; 
$senha = ""; 
$banco = "integrador"; 

// Criar a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
