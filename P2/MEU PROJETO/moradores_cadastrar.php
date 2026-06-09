<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Morador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Cadastro de Morador</h2>

    <form action="moradores_cadastrar.php" method="POST">

      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" placeholder="Digite o nome do morador" required />
      </div>

      <div class="mb-3">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control" name="cpf" placeholder="Digite o CPF do morador" maxlength="11" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" class="form-control" name="telefone" placeholder="Digite o telefone do morador" />
      </div>

      <div class="mb-3">
        <label class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" name="data_nasc" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Apartamento</label>
        <input type="text" class="form-control" name="apartamento" placeholder="Digite o apartamento" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Bloco</label>
        <input type="text" class="form-control" name="bloco" placeholder="Digite o bloco" />
      </div>

        
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="moradores.php" class="btn btn-secondary">Cancelar</a>
        
    </form>
  </div>

<?php
require("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    require("conexao.php");

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['data_nasc'];
    $apartamento = $_POST['apartamento'];
    $bloco = $_POST['bloco'];
    $status = "ativo";

    try{
        $stmt = $pdo->prepare("INSERT INTO moradores (nome, cpf, telefone, data_nasc, apartamento, bloco, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if($stmt->execute([$nome, $cpf, $telefone, $data_nasc, $apartamento, $bloco, $status])){
            header("location: moradores.php?cadastro=true");
        } else{
            header("location: moradores_cadastrar.php?cadastro=false");
        }
    } catch(Exception $e){
        echo "Erro ao executar o comando SQL: ".$e->getMessage();
    }
}
?>

</body>
</html>