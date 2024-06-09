<?php
include 'conexao.php';

// Dados do formulário de cadastro
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];

// Inserir dados de cadastro no banco de dados
$sql_cadastro = "INSERT INTO usuarios (nome, email, cpf, telefone) VALUES ('$nome', '$email', '$cpf', '$telefone')";
if ($conn->query($sql_cadastro) === TRUE) {
    $usuario_id = $conn->insert_id;

    // Dados do formulário de ingresso
    $partida = $_POST['partida'];
    $arqInteira = $_POST['arqInteira'];
    $arqMeia = $_POST['arqMeia'];
    $vipInteira = $_POST['vipInteira'];
    $vipMeia = $_POST['vipMeia'];

    // Calcular o valor total
    $valor_total = ($arqInteira * 80) + ($arqMeia * 40) + ($vipInteira * 200) + ($vipMeia * 100);

    // Inserir dados de ingressos no banco de dados
    $sql_ingresso = "INSERT INTO ingressos (usuario_id, partida, arq_inteira, arq_meia, vip_inteira, vip_meia, valor_total) VALUES ('$usuario_id', '$partida', '$arqInteira', '$arqMeia', '$vipInteira', '$vipMeia', '$valor_total')";
    if ($conn->query($sql_ingresso) === TRUE) {
        echo "Ingressos adquiridos com sucesso!";
    } else {
        echo "Erro: " . $sql_ingresso . "<br>" . $conn->error;
    }
} else {
    echo "Erro: " . $sql_cadastro . "<br>" . $conn->error;
}
