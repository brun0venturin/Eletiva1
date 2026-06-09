<?php

require("cabecalho.php");
require("conexao.php");

$placa = $_GET['placa'] ?? '';
$morador = $_GET['morador'] ?? '';

$sql = "
    SELECT 
        veiculos.id_veiculo,
        veiculos.placa,
        veiculos.modelo,
        veiculos.marca,
        veiculos.cor,
        moradores.nome AS nome_morador,
        moradores.apartamento,
        moradores.bloco
    FROM veiculos
    INNER JOIN moradores ON veiculos.id_morador = moradores.id_morador
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

$sql .= " ORDER BY moradores.nome";

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);

$veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Veículos</h2>
</div>

<div class="card mb-4">
    <div class="card-header">Filtros</div>

    <div class="card-body">
        <form method="GET">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Placa</label>
                    <input type="text" name="placa" class="form-control"
                           value="<?= htmlspecialchars($placa) ?>">
                </div>

                <div class="col-md-5 mb-3">
                    <label>Morador</label>
                    <input type="text" name="morador" class="form-control"
                           value="<?= htmlspecialchars($morador) ?>">
                </div>

                <div class="col-md-3 d-flex align-items-end mb-3">
                    <button class="btn btn-primary me-2">Pesquisar</button>
                    <a href="veiculos.php" class="btn btn-secondary">Limpar</a>
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
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Morador</th>
                    <th>Apartamento</th>
                    <th>Bloco</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($veiculos) > 0): ?>

                <?php foreach ($veiculos as $v): ?>

                    <tr>
                        <td><?= htmlspecialchars($v['placa']) ?></td>
                        <td><?= htmlspecialchars($v['marca']) ?></td>
                        <td><?= htmlspecialchars($v['modelo']) ?></td>
                        <td><?= htmlspecialchars($v['cor']) ?></td>
                        <td><?= htmlspecialchars($v['nome_morador']) ?></td>
                        <td><?= htmlspecialchars($v['apartamento']) ?></td>
                        <td><?= htmlspecialchars($v['bloco']) ?></td>

                        <td>
                            <a href="veiculos_editar.php?id=<?= $v['id_veiculo'] ?>"
                               class="btn btn-warning btn-sm">Editar</a>

                            <a href="veiculos_excluir.php?id=<?= $v['id_veiculo'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja excluir este veículo?')">
                               Excluir
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8" class="text-center">Nenhum veículo encontrado</td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

<?php require("rodape.php"); ?>