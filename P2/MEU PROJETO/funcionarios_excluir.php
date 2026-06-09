<?php
require("cabecalho.php");
require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

try {

    $stmt = $pdo->prepare("
        DELETE FROM funcionarios
        WHERE id_funcionario = ?
    ");

    if ($stmt->execute([$id])) {
        header("location: funcionarios.php?excluido=true");
        exit;
    } else {
        header("location: funcionarios.php?excluido=false");
        exit;
    }

} catch (Exception $e) {
    echo "Erro ao excluir: " . $e->getMessage();
}

?>