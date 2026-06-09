<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("location: moradores.php?excluido=false");
    exit;
}

try {

    $stmt = $pdo->prepare("
        DELETE FROM moradores 
        WHERE id_morador = ?
    ");

    if ($stmt->execute([$id])) {
        header("location: moradores.php?excluido=true");
        exit;
    } else {
        header("location: moradores.php?excluido=false");
        exit;
    }

} catch (PDOException $e) {

    if ($e->getCode() == 23000) {
        header("location: moradores.php?erro_excluir=vinculado");
        exit;
    }

    header("location: moradores.php?excluido=false");
    exit;
}

?>