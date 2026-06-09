<?php

require("cabecalho.php");
require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM moradores WHERE id_morador = ?");
$stmt->execute([$id]);

header("location: moradores.php?excluido=true");
exit;

?>