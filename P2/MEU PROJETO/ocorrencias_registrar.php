<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("conexao.php");

    $id_morador = $_POST['id_morador'];
    $id_funcionario = $_POST['id_funcionario'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_ocorrencia = $_POST['data_ocorrencia'];
    $status = "aberta";

    try {
        $stmt = $pdo->prepare("
            INSERT INTO ocorrencias
            (id_morador, id_funcionario, titulo, descricao, data_ocorrencia, status)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        if ($stmt->execute([$id_morador, $id_funcionario, $titulo, $descricao, $data_ocorrencia, $status])) {
            header("location: ocorrencias.php?cadastro=true");
            exit;
        } else {
            header("location: ocorrencias_registrar.php?cadastro=false");
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
        SELECT id_morador, nome, apartamento, bloco 
        FROM moradores 
        WHERE status = 'ativo' 
        ORDER BY nome ASC
    ");

    $stmt->execute();
    $moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("
        SELECT id_funcionario, nome, cargo 
        FROM funcionarios 
        WHERE status = 'ativo' 
        ORDER BY nome ASC
    ");

    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro ao buscar dados: " . $e->getMessage();
    exit;
}

?>

<div class="container mt-3">
    <h2 class="mb-4">Cadastro de Ocorrência</h2>

    <form action="ocorrencias_registrar.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Morador</label>

            <select class="form-control" name="id_morador" required>
                <option value="">Selecione o morador</option>

                <?php foreach ($moradores as $morador) { ?>
                    <option value="<?= $morador['id_morador'] ?>">
                        <?= htmlspecialchars($morador['nome']) ?> 
                        - Apto <?= htmlspecialchars($morador['apartamento']) ?> 
                        - Bloco <?= htmlspecialchars($morador['bloco']) ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Funcionário</label>

            <select class="form-control" name="id_funcionario" required>
                <option value="">Selecione o funcionário</option>

                <?php foreach ($funcionarios as $funcionario) { ?>
                    <option value="<?= $funcionario['id_funcionario'] ?>">
                        <?= htmlspecialchars($funcionario['nome']) ?> 
                        - <?= htmlspecialchars($funcionario['cargo']) ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>

            <input 
                type="text" 
                class="form-control" 
                name="titulo" 
                placeholder="Digite o título da ocorrência" 
                required 
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>

            <textarea 
                class="form-control" 
                name="descricao" 
                rows="4" 
                placeholder="Digite a descrição da ocorrência" 
                required
            ></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Data da Ocorrência</label>

            <input 
                type="date" 
                class="form-control" 
                name="data_ocorrencia" 
                required 
            />
        </div>

        <button type="submit" class="btn btn-success">
            Cadastrar
        </button>

        <a href="ocorrencias.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>
</div>