<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

try {

    $stmt = $pdo->prepare("DELETE FROM veiculos WHERE id_veiculo = ?");

    if ($stmt->execute([$id])) {
        header("location: veiculos.php?excluido=true");
        exit;
    } else {
        header("location: veiculos.php?excluido=false");
        exit;
    }

} catch (Exception $e) {
    echo "Erro ao excluir veículo: " . $e->getMessage();
}

?>