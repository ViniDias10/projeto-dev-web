<?php
include 'conexao.php';

$id = $_POST['id'];
$partida = $_POST['partida'];
$arqInteira = $_POST['arqInteira'];
$arqMeia = $_POST['arqMeia'];
$vipInteira = $_POST['vipInteira'];
$vipMeia = $_POST['vipMeia'];

$sql = "UPDATE ingressos SET 
            partida='$partida', 
            arq_inteira='$arqInteira', 
            arq_meia='$arqMeia', 
            vip_inteira='$vipInteira', 
            vip_meia='$vipMeia'
        WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Ingresso atualizado com sucesso.";
} else {
    echo "Erro ao atualizar ingresso: " . $conn->error;
}

