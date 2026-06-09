<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $telefone = $_POST['telefone'];
    $status = $_POST['status'];
    $cargo = $_POST['cargo'];

    try {
        $stmt = $pdo->prepare("
            UPDATE funcionarios
            SET telefone = ?, status = ?, cargo = ?
            WHERE id_funcionario = ?
        ");

        if ($stmt->execute([$telefone, $status, $cargo, $id])) {
            header("location: funcionarios.php?editado=true");
            exit;
        } else {
            header("location: funcionarios.php?editado=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao atualizar: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id_funcionario = ?");
$stmt->execute([$id]);
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$funcionario) {
    echo "Funcionário não encontrado.";
    exit;
}

require("cabecalho.php");
?>

<div class="container mt-4">

    <h2>Editar Funcionário</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($funcionario['nome']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label>CPF</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($funcionario['cpf']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($funcionario['email']) ?>" disabled>
        </div>

        <!-- PODE EDITA -->

        <div class="mb-3">
            <label>Cargo</label>
            <select name="cargo" class="form-control" required>
                <option value="porteiro" <?= $funcionario['cargo'] == 'porteiro' ? 'selected' : '' ?>>Porteiro</option>
                <option value="síndico" <?= $funcionario['cargo'] == 'síndico' ? 'selected' : '' ?>>Síndico</option>
                <option value="conselheiro" <?= $funcionario['cargo'] == 'conselheiro' ? 'selected' : '' ?>>Conselheiro</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Data Admissão</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($funcionario['data_admissao']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control"
                   value="<?= htmlspecialchars($funcionario['telefone']) ?>">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="ativo" <?= $funcionario['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="inativo" <?= $funcionario['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="funcionarios.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

<?php require("rodape.php"); ?>