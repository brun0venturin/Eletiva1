<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("location: funcionarios.php?excluido=false");
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

} catch (PDOException $e) {

    if ($e->getCode() == 23000) {
        header("location: funcionarios.php?erro_excluir=vinculado");
        exit;
    }

    header("location: funcionarios.php?excluido=false");
    exit;
}

?>