<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("location: veiculos.php?excluido=false");
    exit;
}

try {

    $stmt = $pdo->prepare("
        DELETE FROM veiculos 
        WHERE id_veiculo = ?
    ");

    if ($stmt->execute([$id])) {
        header("location: veiculos.php?excluido=true");
        exit;
    } else {
        header("location: veiculos.php?excluido=false");
        exit;
    }

} catch (PDOException $e) {

    if ($e->getCode() == 23000) {
        header("location: veiculos.php?erro_excluir=vinculado");
        exit;
    }

    header("location: veiculos.php?excluido=false");
    exit;
}

?>