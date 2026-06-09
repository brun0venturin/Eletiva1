<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("conexao.php");

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $data_admissao = $_POST['data_admissao'];
    $status = "ativo";

    try {
        $stmt = $pdo->prepare("
            INSERT INTO funcionarios 
            (nome, cpf, email, senha, telefone, cargo, data_admissao, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmt->execute([$nome, $cpf, $email, $senha, $telefone, $cargo, $data_admissao, $status])) {
            header("location: funcionarios.php?cadastro=true");
            exit;
        } else {
            header("location: funcionarios_cadastrar.php?cadastro=false");
            exit;
        }

    } catch (Exception $e) {
        echo "Erro ao executar o comando SQL: " . $e->getMessage();
        exit;
    }
}

require("cabecalho.php");

?>

<div class="container mt-3">
    <h2 class="mb-4">Cadastro de Funcionário</h2>

    <form action="funcionarios_cadastrar.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input 
                type="text" 
                class="form-control" 
                name="nome" 
                required 
                placeholder="Antonio Silva"
            />
        </div>

        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input 
                type="text" 
                class="form-control" 
                name="cpf" 
                maxlength="11" 
                placeholder="47788260846" 
                required 
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input 
                type="email" 
                class="form-control" 
                name="email" 
                placeholder="nome.sobrenome@condominio.com" 
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input 
                type="password" 
                class="form-control" 
                name="senha" 
                required 
                placeholder="Digite a senha"
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input 
                type="text" 
                class="form-control" 
                name="telefone" 
                placeholder="18123451234"
            />
        </div>

        <div class="mb-3">
            <label class="form-label">Cargo</label>
            <select class="form-control" name="cargo" required>
                <option value="porteiro">Porteiro</option>
                <option value="síndico">Síndico</option>
                <option value="conselheiro">Conselheiro</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Admissão</label>
            <input 
                type="date" 
                class="form-control" 
                name="data_admissao" 
                required 
            />
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>

        <a href="funcionarios.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>
</div>