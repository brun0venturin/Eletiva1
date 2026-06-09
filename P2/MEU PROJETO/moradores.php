<?php

require("cabecalho.php");
require("conexao.php");

$nome = $_GET['nome'] ?? '';
$apartamento = $_GET['apartamento'] ?? '';

$sql = "
    SELECT *
    FROM moradores
    WHERE 1=1
";

$parametros = [];

if (!empty($nome)) {
    $sql .= " AND nome LIKE ?";
    $parametros[] = "%{$nome}%";
}

if (!empty($apartamento)) {
    $sql .= " AND apartamento LIKE ?";
    $parametros[] = "%{$apartamento}%";
}

$sql .= " ORDER BY nome";

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);

$moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Moradores</h2>
</div>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success">
        Morador cadastrado com sucesso!
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">Filtros</div>

    <div class="card-body">
        <form method="GET">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control"
                           value="<?= htmlspecialchars($nome) ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Apartamento</label>
                    <input type="text" name="apartamento" class="form-control"
                           value="<?= htmlspecialchars($apartamento) ?>">
                </div>

                <div class="col-md-3 d-flex align-items-end mb-3">
                    <button class="btn btn-primary me-2">Pesquisar</button>
                    <a href="moradores.php" class="btn btn-secondary">Limpar</a>
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
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Apartamento</th>
                    <th>Bloco</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($moradores) > 0): ?>

                <?php foreach ($moradores as $m): ?>

                    <tr>
                        <td><?= htmlspecialchars($m['nome']) ?></td>
                        <td><?= htmlspecialchars($m['cpf']) ?></td>
                        <td><?= htmlspecialchars($m['apartamento']) ?></td>
                        <td><?= htmlspecialchars($m['bloco']) ?></td>
                        <td><?= htmlspecialchars($m['telefone']) ?></td>
                        <td><?= htmlspecialchars($m['status']) ?></td>

                        <td>
                            <a href="moradores_editar.php?id=<?= $m['id_morador'] ?>"
                               class="btn btn-warning btn-sm">Editar</a>

                            <a href="moradores_excluir.php?id=<?= $m['id_morador'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja excluir este morador?')">
                               Excluir
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7" class="text-center">Nenhum morador encontrado</td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

<?php require("rodape.php"); ?>