<?php

require("cabecalho.php");
require("conexao.php");

$titulo = $_GET['titulo'] ?? '';
$morador = $_GET['morador'] ?? '';
$status = $_GET['status'] ?? '';

$sql = "
    SELECT 
        ocorrencias.id_ocorrencia,
        ocorrencias.titulo,
        ocorrencias.descricao,
        ocorrencias.data_ocorrencia,
        ocorrencias.status,
        moradores.nome AS nome_morador,
        funcionarios.nome AS nome_funcionario
    FROM ocorrencias
    INNER JOIN moradores ON ocorrencias.id_morador = moradores.id_morador
    INNER JOIN funcionarios ON ocorrencias.id_funcionario = funcionarios.id_funcionario
    WHERE 1=1
";

$parametros = [];

if (!empty($titulo)) {
    $sql .= " AND ocorrencias.titulo LIKE ?";
    $parametros[] = "%{$titulo}%";
}

if (!empty($morador)) {
    $sql .= " AND moradores.nome LIKE ?";
    $parametros[] = "%{$morador}%";
}

if (!empty($status)) {
    $sql .= " AND ocorrencias.status = ?";
    $parametros[] = $status;
}

$sql .= " ORDER BY ocorrencias.data_ocorrencia DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);

$ocorrencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Ocorrências</h2>
</div>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success">
        Ocorrência registrada com sucesso!
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">Filtros</div>

    <div class="card-body">
        <form method="GET">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Título</label>
                    <input type="text" name="titulo" class="form-control"
                           value="<?= htmlspecialchars($titulo) ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Morador</label>
                    <input type="text" name="morador" class="form-control"
                           value="<?= htmlspecialchars($morador) ?>">
                </div>

                <div class="col-md-2 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="aberta" <?= $status == 'aberta' ? 'selected' : '' ?>>Aberta</option>
                        <option value="finalizada" <?= $status == 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end mb-3">
                    <button class="btn btn-primary me-2">Pesquisar</button>
                    <a href="ocorrencias.php" class="btn btn-secondary">Limpar</a>
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
                    <th>Título</th>
                    <th>Morador</th>
                    <th>Funcionário</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($ocorrencias) > 0): ?>

                <?php foreach ($ocorrencias as $o): ?>

                    <tr>
                        <td><?= htmlspecialchars($o['titulo']) ?></td>
                        <td><?= htmlspecialchars($o['nome_morador']) ?></td>
                        <td><?= htmlspecialchars($o['nome_funcionario']) ?></td>
                        <td><?= htmlspecialchars($o['data_ocorrencia']) ?></td>
                        <td><?= htmlspecialchars($o['status']) ?></td>

                        <td>
                            <a href="ocorrencias_editar.php?id=<?= $o['id_ocorrencia'] ?>"
                               class="btn btn-warning btn-sm">Editar</a>

                            <a href="ocorrencias_excluir.php?id=<?= $o['id_ocorrencia'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja excluir esta ocorrência?')">
                               Excluir
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6" class="text-center">Nenhuma ocorrência encontrada</td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

<?php require("rodape.php"); ?>