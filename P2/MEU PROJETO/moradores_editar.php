<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $telefone = $_POST['telefone'];
    $apartamento = $_POST['apartamento'];
    $bloco = $_POST['bloco'];
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("
            UPDATE moradores
            SET telefone = ?, apartamento = ?, bloco = ?, status = ?
            WHERE id_morador = ?
        ");

        if ($stmt->execute([$telefone, $apartamento, $bloco, $status, $id])) {
            header("location: moradores.php?editado=true");
            exit;
        } else {
            header("location: moradores.php?editado=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao atualizar: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM moradores WHERE id_morador = ?");
$stmt->execute([$id]);
$morador = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$morador) {
    echo "Morador não encontrado.";
    exit;
}

require("cabecalho.php");
?>

<div class="container mt-4">

    <h2>Editar Morador</h2>

    <form method="POST">

        <!-- BLOQUEADOS (SOMENTE VISUALIZAÇÃO) -->

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" class="form-control"
                   value="<?= htmlspecialchars($morador['nome']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label>CPF</label>
            <input type="text" class="form-control"
                   value="<?= htmlspecialchars($morador['cpf']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="text" class="form-control"
                   value="<?= htmlspecialchars($morador['data_nasc']) ?>" disabled>
        </div>

        <!-- EDITÁVEIS -->

        <div class="mb-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control"
                   placeholder="Digite o telefone do morador"
                   value="<?= htmlspecialchars($morador['telefone']) ?>">
        </div>

        <div class="mb-3">
            <label>Apartamento</label>
            <input type="text" name="apartamento" class="form-control"
                   placeholder="Digite o apartamento"
                   value="<?= htmlspecialchars($morador['apartamento']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Bloco</label>
            <input type="text" name="bloco" class="form-control"
                   placeholder="Digite o bloco"
                   value="<?= htmlspecialchars($morador['bloco']) ?>">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="ativo" <?= $morador['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="inativo" <?= $morador['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="moradores.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

<?php require("rodape.php"); ?>