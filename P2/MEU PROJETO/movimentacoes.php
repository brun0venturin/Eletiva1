<?php

require("cabecalho.php");
require("conexao.php");

$placa = $_GET['placa'] ?? '';
$morador = $_GET['morador'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$data = $_GET['data'] ?? '';

$sql = "
    SELECT
        movimentacoes.id_movimentacao,
        movimentacoes.tipo,
        movimentacoes.data_movimentacao,
        movimentacoes.observacao,

        moradores.nome AS nome_morador,
        moradores.apartamento,
        moradores.bloco,

        veiculos.placa,
        veiculos.marca,
        veiculos.modelo,
        veiculos.cor

    FROM movimentacoes
    INNER JOIN moradores ON movimentacoes.id_morador = moradores.id_morador
    INNER JOIN veiculos ON movimentacoes.id_veiculo = veiculos.id_veiculo
    WHERE 1=1
";

$parametros = [];

if (!empty($placa)) {
    $sql .= " AND veiculos.placa LIKE ?";
    $parametros[] = "%{$placa}%";
}

if (!empty($morador)) {
    $sql .= " AND moradores.nome LIKE ?";
    $parametros[] = "%{$morador}%";
}

if (!empty($tipo)) {
    $sql .= " AND movimentacoes.tipo = ?";
    $parametros[] = $tipo;
}

if (!empty($data)) {
    $sql .= " AND DATE(movimentacoes.data_movimentacao) = ?";
    $parametros[] = $data;
}

$sql .= " ORDER BY movimentacoes.data_movimentacao DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);

$movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Movimentações</h2>
    
</div>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success">
        Movimentação registrada com sucesso!
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">Filtros</div>

    <div class="card-body">
        <form method="GET">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Placa</label>
                    <input type="text" name="placa" class="form-control"
                           value="<?= htmlspecialchars($placa) ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Morador</label>
                    <input type="text" name="morador" class="form-control"
                           value="<?= htmlspecialchars($morador) ?>">
                </div>

                <div class="col-md-2 mb-3">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control">
                        <option value="">Todos</option>
                        <option value="entrada" <?= $tipo == 'entrada' ? 'selected' : '' ?>>Entrada</option>
                        <option value="saida" <?= $tipo == 'saida' ? 'selected' : '' ?>>Saída</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Data</label>
                    <input type="date" name="data" class="form-control"
                           value="<?= htmlspecialchars($data) ?>">
                </div>

                <div class="col-md-2 d-flex align-items-end mb-3">
                    <button class="btn btn-primary me-2">Pesquisar</button>
                    <a href="movimentacoes.php" class="btn btn-secondary">Limpar</a>
                </div>

            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-striped table-hover">

            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Data/Hora</th>
                    <th>Morador</th>
                    <th>Apartamento</th>
                    <th>Bloco</th>
                    <th>Placa</th>
                    <th>Veículo</th>
                    <th>Cor</th>
                    <th>Observação</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($movimentacoes) > 0): ?>

                <?php foreach ($movimentacoes as $m): ?>

                    <tr>
                        <td>
                            <?php if ($m['tipo'] == 'entrada'): ?>
                                Entrada
                            <?php else: ?>
                                Saída
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($m['data_movimentacao']) ?></td>
                        <td><?= htmlspecialchars($m['nome_morador']) ?></td>
                        <td><?= htmlspecialchars($m['apartamento']) ?></td>
                        <td><?= htmlspecialchars($m['bloco']) ?></td>
                        <td><?= htmlspecialchars($m['placa']) ?></td>
                        <td><?= htmlspecialchars($m['marca']) ?> <?= htmlspecialchars($m['modelo']) ?></td>
                        <td><?= htmlspecialchars($m['cor']) ?></td>
                        <td><?= htmlspecialchars($m['observacao']) ?></td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="9" class="text-center">Nenhuma movimentação encontrada</td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

<?php require("rodape.php"); ?>