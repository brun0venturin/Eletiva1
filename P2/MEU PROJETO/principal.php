<?php
    require("cabecalho.php");
    require("conexao.php");

    $total_moradores = 0;
    $total_veiculos = 0;
    $total_ocorrencias = 0;
    $total_movimentacoes = 0;

    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM moradores");
        $stmt->execute();
        $total_moradores = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM veiculos");
        $stmt->execute();
        $total_veiculos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM ocorrencias");
        $stmt->execute();
        $total_ocorrencias = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM movimentacoes");
        $stmt->execute();
        $total_movimentacoes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    } catch (Exception $e) {
        echo "Erro ao buscar informações: " . $e->getMessage();
    }
?>

<div class="container mt-4">

    <div class="card shadow-sm mb-4">
        <div class="card-body text-center p-4">
            <h2 class="mb-2">
                Bem-vindo, <?= $_SESSION['nome'] ?>!
            </h2>

            <p class="text-muted mb-0">
                Painel principal do Sistema de Gerenciamento do Condomínio
            </p>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Moradores</h5>

                    <h1 class="text-primary mb-0">
                        <?= $total_moradores ?>
                    </h1>

                    <small class="text-muted">
                        Moradores cadastrados.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Veículos</h5>

                    <h1 class="text-success mb-0">
                        <?= $total_veiculos ?>
                    </h1>

                    <small class="text-muted">
                        Veículos cadastrados.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Ocorrências</h5>

                    <h1 class="text-danger mb-0">
                        <?= $total_ocorrencias ?>
                    </h1>

                    <small class="text-muted">
                        Ocorrências registradas.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Movimentações</h5>


                    <h1 class="text-warning mb-0">
                        <?= $total_movimentacoes ?>
                    </h1>

                    <small class="text-muted">
                        Movimentações registradas.
                    </small>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    Próxima Assembleia
                </div>
                <div class="card-body">
                    <p class="card-text mb-0">
                        15 de Junho às 19h no salão de festas.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-warning shadow-sm h-100">
                <div class="card-header bg-warning">
                    Manutenção
                </div>
                <div class="card-body">
                    <p class="card-text mb-0">
                        Elevador passará por manutenção dia 10/06.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    Reservas
                </div>
                <div class="card-body">
                    <p class="card-text mb-0">
                        Salão de festas reservado para 14/06 - Jose Apto 29. 
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
  require("rodape.php");
?>