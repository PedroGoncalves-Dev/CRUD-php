<?php
// Informações de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root"; // Usuário padrão do MySQL no XAMPP
$senha = ""; // Senha padrão do MySQL no XAMPP
$banco = "integrador"; // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
