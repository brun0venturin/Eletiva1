<?php

require("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_morador = $_POST['id_morador'];
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];

    try {
        $stmt = $pdo->prepare("
            UPDATE veiculos
            SET id_morador = ?, placa = ?, marca = ?, modelo = ?, cor = ?
            WHERE id_veiculo = ?
        ");

        if ($stmt->execute([$id_morador, $placa, $marca, $modelo, $cor, $id])) {
            header("location: veiculos.php?editado=true");
            exit;
        } else {
            header("location: veiculos.php?editado=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao atualizar: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id_veiculo = ?");
$stmt->execute([$id]);
$veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$veiculo) {
    echo "Veículo não encontrado.";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id_morador, nome, apartamento, bloco FROM moradores WHERE status = 'ativo' ORDER BY nome ASC");
    $stmt->execute();
    $moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro ao buscar moradores: " . $e->getMessage();
}

require("cabecalho.php");
?>

<div class="container mt-4">

    <h2>Editar Veículo</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Morador</label>
            <select name="id_morador" class="form-control" required>
                <option value="">Selecione o morador</option>

                <?php foreach ($moradores as $morador) { ?>
                    <option value="<?= $morador['id_morador'] ?>"
                        <?= $veiculo['id_morador'] == $morador['id_morador'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($morador['nome']) ?> - 
                        Apto <?= htmlspecialchars($morador['apartamento']) ?> - 
                        Bloco <?= htmlspecialchars($morador['bloco']) ?>

                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label>Placa</label>
            <input type="text" name="placa" class="form-control"
                   placeholder="Digite a placa do veículo"
                   maxlength="10"
                   value="<?= htmlspecialchars($veiculo['placa']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Marca</label>
            <input type="text" name="marca" class="form-control"
                   placeholder="Digite a marca do veículo"
                   value="<?= htmlspecialchars($veiculo['marca']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Modelo</label>
            <input type="text" name="modelo" class="form-control"
                   placeholder="Digite o modelo do veículo"
                   value="<?= htmlspecialchars($veiculo['modelo']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Cor</label>
            <input type="text" name="cor" class="form-control"
                   placeholder="Digite a cor do veículo"
                   value="<?= htmlspecialchars($veiculo['cor']) ?>"
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="veiculos.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

<?php require("rodape.php"); ?>