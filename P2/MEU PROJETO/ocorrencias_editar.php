<?php

require("cabecalho.php");
require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_morador = $_POST['id_morador'];
    $id_funcionario = $_POST['id_funcionario'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_ocorrencia = $_POST['data_ocorrencia'];
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("
            UPDATE ocorrencias
            SET id_morador = ?, id_funcionario = ?, titulo = ?, descricao = ?, data_ocorrencia = ?, status = ?
            WHERE id_ocorrencia = ?
        ");

        if ($stmt->execute([$id_morador, $id_funcionario, $titulo, $descricao, $data_ocorrencia, $status, $id])) {
            header("location: ocorrencias.php?editado=true");
            exit;
        } else {
            header("location: ocorrencias.php?editado=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao atualizar: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM ocorrencias WHERE id_ocorrencia = ?");
$stmt->execute([$id]);
$ocorrencia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ocorrencia) {
    echo "Ocorrência não encontrada.";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id_morador, nome, apartamento, bloco FROM moradores WHERE status = 'ativo' ORDER BY nome ASC");
    $stmt->execute();
    $moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT id_funcionario, nome, cargo FROM funcionarios WHERE status = 'ativo' ORDER BY nome ASC");
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro ao buscar dados: " . $e->getMessage();
}

require("cabecalho.php");
?>

<div class="container mt-4">

    <h2>Editar Ocorrência</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Morador</label>
            <select name="id_morador" class="form-control" required>
                <option value="">Selecione o morador</option>

                <?php foreach ($moradores as $morador) { ?>
                    <option value="<?= $morador['id_morador'] ?>"
                        <?= $ocorrencia['id_morador'] == $morador['id_morador'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($morador['nome']) ?> -
                        Apto <?= htmlspecialchars($morador['apartamento']) ?> -
                        Bloco <?= htmlspecialchars($morador['bloco']) ?>

                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label>Funcionário</label>
            <select name="id_funcionario" class="form-control" required>
                <option value="">Selecione o funcionário</option>

                <?php foreach ($funcionarios as $funcionario) { ?>
                    <option value="<?= $funcionario['id_funcionario'] ?>"
                        <?= $ocorrencia['id_funcionario'] == $funcionario['id_funcionario'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($funcionario['nome']) ?> -
                        <?= htmlspecialchars($funcionario['cargo']) ?>

                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control"
                   placeholder="Digite o título da ocorrência"
                   value="<?= htmlspecialchars($ocorrencia['titulo']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" rows="4"
                      placeholder="Digite a descrição da ocorrência"
                      required><?= htmlspecialchars($ocorrencia['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Data da Ocorrência</label>
            <input type="date" name="data_ocorrencia" class="form-control"
                   value="<?= htmlspecialchars($ocorrencia['data_ocorrencia']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aberta" <?= $ocorrencia['status'] == 'aberta' ? 'selected' : '' ?>>Aberta</option>
                <option value="finalizada" <?= $ocorrencia['status'] == 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="ocorrencias.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

<?php require("rodape.php"); ?>