<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Veículo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<?php
require("cabecalho.php");
require("conexao.php");

try {
    $stmt = $pdo->prepare("SELECT id_morador, nome, apartamento, bloco FROM moradores WHERE status = 'ativo' ORDER BY nome ASC");
    $stmt->execute();
    $moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro ao buscar moradores: " . $e->getMessage();
}
?>

  <div class="container mt-5">
    <h2 class="mb-4">Cadastro de Veículo</h2>

    <form action="veiculos_cadastrar.php" method="POST">

      <div class="mb-3">
        <label class="form-label">Morador</label>
        <select class="form-control" name="id_morador" required>
          <option value="">Selecione o morador</option>

          <?php foreach ($moradores as $morador) { ?>
            <option value="<?= $morador['id_morador'] ?>">
              <?= htmlspecialchars($morador['nome']) ?> - Apto <?= htmlspecialchars($morador['apartamento']) ?> - Bloco <?= htmlspecialchars($morador['bloco']) ?>
            </option>
          <?php } ?>

        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Placa</label>
        <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veículo" maxlength="10" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Marca</label>
        <input type="text" class="form-control" name="marca" placeholder="Digite a marca do veículo" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Modelo</label>
        <input type="text" class="form-control" name="modelo" placeholder="Digite o modelo do veículo" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Cor</label>
        <input type="text" class="form-control" name="cor" placeholder="Digite a cor do veículo" required />
      </div>

      <button type="submit" class="btn btn-success">Cadastrar</button>

      <a href="veiculos.php" class="btn btn-secondary">Cancelar</a>

    </form>
  </div>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $id_morador = $_POST['id_morador'];
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];

    try{
        $stmt = $pdo->prepare("
            INSERT INTO veiculos 
            (id_morador, placa, marca, modelo, cor) 
            VALUES (?, ?, ?, ?, ?)
        ");

        if($stmt->execute([$id_morador, $placa, $marca, $modelo, $cor])){
            header("location: veiculos.php?cadastro=true");
            exit;
        } else{
            header("location: veiculos_cadastrar.php?cadastro=false");
            exit;
        }

    } catch(Exception $e){
        echo "Erro ao executar o comando SQL: ".$e->getMessage();
    }
}

?>

</body>
</html>