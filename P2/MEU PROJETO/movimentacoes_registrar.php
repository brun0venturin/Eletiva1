<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("conexao.php");

    $tipo = $_POST['tipo'];
    $id_veiculo = $_POST['id_veiculo'];
    $data_movimentacao = $_POST['data_movimentacao'];
    $observacao = $_POST['observacao'];

    try {
        $stmt = $pdo->prepare("
            SELECT id_morador 
            FROM veiculos 
            WHERE id_veiculo = ?
        ");

        $stmt->execute([$id_veiculo]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$veiculo) {
            echo "Veículo não encontrado.";
            exit;
        }

        $id_morador = $veiculo['id_morador'];

        $stmt = $pdo->prepare("
            INSERT INTO movimentacoes
            (id_morador, id_veiculo, tipo, data_movimentacao, observacao)
            VALUES (?, ?, ?, ?, ?)
        ");

        if ($stmt->execute([$id_morador, $id_veiculo, $tipo, $data_movimentacao, $observacao])) {
            header("location: movimentacoes.php?cadastro=true");
            exit;
        } else {
            header("location: movimentacoes_registrar.php?cadastro=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao executar o comando SQL: " . $e->getMessage();
        exit;
    }
}

require("cabecalho.php");
require("conexao.php");

try {
    $stmt = $pdo->prepare("
        SELECT
            veiculos.id_veiculo,
            veiculos.placa,
            veiculos.marca,
            veiculos.modelo,
            veiculos.cor,
            moradores.nome AS nome_morador,
            moradores.apartamento,
            moradores.bloco
        FROM veiculos
        INNER JOIN moradores ON veiculos.id_morador = moradores.id_morador
        ORDER BY moradores.nome ASC
    ");

    $stmt->execute();
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro ao buscar veículos: " . $e->getMessage();
    exit;
}

?>

<div class="container mt-3">
    <h2 class="mb-4">Registrar Movimentação</h2>

    <form action="movimentacoes_registrar.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Tipo de Movimentação</label>

            <select class="form-control" name="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Veículo / Morador</label>

            <select class="form-control" name="id_veiculo" required>
                <option value="">Selecione o veículo</option>

                <?php foreach ($veiculos as $veiculo) { ?>
                    <option value="<?= $veiculo['id_veiculo'] ?>">
                        <?= htmlspecialchars($veiculo['placa']) ?> -
                        <?= htmlspecialchars($veiculo['marca']) ?>
                        <?= htmlspecialchars($veiculo['modelo']) ?> -
                        <?= htmlspecialchars($veiculo['nome_morador']) ?> -
                        Apto <?= htmlspecialchars($veiculo['apartamento']) ?> -
                        Bloco <?= htmlspecialchars($veiculo['bloco']) ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Data e Hora</label>

            <input 
                type="datetime-local" 
                class="form-control" 
                name="data_movimentacao" 
                required 
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Observação</label>

            <input 
                type="text" 
                class="form-control" 
                name="observacao" 
                placeholder="Digite uma observação, se necessário" 
            />
        </div>

        <button type="submit" class="btn btn-success">
            Registrar
        </button>

        <a href="movimentacoes.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>
</div>