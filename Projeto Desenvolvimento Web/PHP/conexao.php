<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ingressos";

// Criar conexão com o banco de dados MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação da tabela usuarios
$sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    telefone VARCHAR(20) NOT NULL
)";

if ($conn->query($sqlUsuarios) === TRUE) {
    echo "Tabela usuarios criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela usuarios: " . $conn->error . "<br>";
}

// Criação da tabela ingressos
$sqlIngressos = "CREATE TABLE IF NOT EXISTS ingressos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    partida VARCHAR(255) NOT NULL,
    arq_inteira INT NOT NULL,
    arq_meia INT NOT NULL,
    vip_inteira INT NOT NULL,
    vip_meia INT NOT NULL,
    valor_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";

if ($conn->query($sqlIngressos) === TRUE) {
    echo "Tabela ingressos criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela ingressos: " . $conn->error . "<br>";
}


