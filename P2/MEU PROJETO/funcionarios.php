<?php

require("cabecalho.php");
require("conexao.php");

$nome = $_GET['nome'] ?? '';
$cargo = $_GET['cargo'] ?? '';

$sql = "
    SELECT *
    FROM funcionarios
    WHERE 1=1
";

$parametros = [];

if (!empty($nome)) {
    $sql .= " AND nome LIKE ?";
    $parametros[] = "%{$nome}%";
}

if (!empty($cargo)) {
    $sql .= " AND cargo LIKE ?";
    $parametros[] = "%{$cargo}%";
}

$sql .= " ORDER BY nome";

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);

$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Funcionários</h2>
</div>

<?php if (isset($_GET['erro_excluir']) && $_GET['erro_excluir'] == 'vinculado'): ?>
    <div class="alert alert-danger">
        Esse funcionário não pode ser excluído, pois já foram atribuídos registros a ele.
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        Filtros
    </div>

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome</label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        value="<?= htmlspecialchars($nome) ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Cargo</label>

                    <input
                        type="text"
                        name="cargo"
                        class="form-control"
                        value="<?= htmlspecialchars($cargo) ?>">
                </div>

                <div class="col-md-3 d-flex align-items-end mb-3">

                    <button type="submit" class="btn btn-primary me-2">
                        Pesquisar
                    </button>

                    <a href="funcionarios.php" class="btn btn-secondary">
                        Limpar
                    </a>

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
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th width="170">Ações</th>
                </tr>

            </thead>

            <tbody>

            <?php if (count($funcionarios) > 0): ?>

                <?php foreach ($funcionarios as $funcionario): ?>

                    <tr>

                        <td><?= htmlspecialchars($funcionario['nome']) ?></td>

                        <td><?= htmlspecialchars($funcionario['cpf']) ?></td>

                        <td><?= htmlspecialchars($funcionario['email']) ?></td>

                        <td><?= htmlspecialchars($funcionario['telefone']) ?></td>

                        <td><?= htmlspecialchars($funcionario['cargo']) ?></td>

                        <td><?= htmlspecialchars($funcionario['status']) ?></td>

                        <td>

                            <a
                                href="funcionarios_editar.php?id=<?= $funcionario['id_funcionario'] ?>"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <a
                                href="funcionarios_excluir.php?id=<?= $funcionario['id_funcionario'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Deseja realmente excluir este funcionário?')">
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7" class="text-center">
                        Nenhum funcionário encontrado.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php
require("rodape.php");
?>