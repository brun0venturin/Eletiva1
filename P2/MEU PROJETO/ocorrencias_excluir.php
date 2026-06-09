<?php

require("cabecalho.php");
require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

try {

    $stmt = $pdo->prepare("DELETE FROM ocorrencias WHERE id_ocorrencia = ?");

    if ($stmt->execute([$id])) {
        header("location: ocorrencias.php?excluido=true");
        exit;
    } else {
        header("location: ocorrencias.php?excluido=false");
        exit;
    }

} catch (Exception $e) {
    echo "Erro ao excluir ocorrência: " . $e->getMessage();
}

?>