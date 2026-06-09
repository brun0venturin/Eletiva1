<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Sistema de Condomínio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">

  <div class="container">

    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

      <div class="col-md-5">

        <div class="card shadow">

          <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Bela Vista</h4>
          </div>

          <div class="card-body p-4">

            <?php       

              if($_SERVER['REQUEST_METHOD'] == "POST"){
                require('conexao.php');

                $email = $_POST['email'];
                $senha = $_POST['senha'];

                try{
                  $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE email = ?");
                  $stmt->execute([$email]);
                  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                  if($usuario && password_verify($senha, $usuario['senha'])){
                    session_start();
                    $_SESSION['acesso'] = true;
                    $_SESSION['nome'] = $usuario['nome'];
                    header('location: principal.php');
                  } else {
                    echo "<div class='alert alert-danger'>Credenciais inválidas!</div>";
                  }

                } catch(\Exception $e){
                  echo "<div class='alert alert-danger'>Erro: ".$e->getMessage()."</div>";
                }
              }
            ?>

            <h5 class="mb-3 text-center">Acesso ao Sistema</h5>

            <p class="text-muted text-center mb-4">
              Informe seu email e senha para acessar o painel.
            </p>

            <form action="index.php" method="POST">

              <div class="mb-3">
                <label for="emailLogin" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailLogin" name="email"
                       placeholder="Digite seu email" required />
              </div>

              <div class="mb-3">
                <label for="senhaLogin" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senhaLogin" name="senha"
                       placeholder="Digite sua senha" required />
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                  Entrar
                </button>
              </div>

            </form>

          </div>

          <div class="card-footer text-center text-muted">
            Controle de moradores, veículos, ocorrências e movimentações
          </div>

        </div>

      </div>

    </div>

  </div>

</body>

</html>