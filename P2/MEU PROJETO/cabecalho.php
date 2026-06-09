<?php
  session_start();
  if(!isset($_SESSION['acesso']))
    header('location: index.php');
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bela Vista</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print{
        display: none !important;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark no-print">
    <div class="container">
      <a class="navbar-brand" href="principal.php">Bela Vista</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="principal.php">Início</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Moradores
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="moradores.php">Consultar</a></li>
              <li><a class="dropdown-item" href="moradores_cadastrar.php">Cadastrar</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Veiculos
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="veiculos.php">Consultar</a></li>
              <li><a class="dropdown-item" href="veiculos_cadastrar.php">Cadastrar</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ocorrências
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="ocorrencias.php">Consultar</a></li>
              <li><a class="dropdown-item" href="ocorrencias_registar.php">Registrar</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Movimentações
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="movimentacoes.php">Consultar</a></li>
              <li><a class="dropdown-item" href="movimentacoes_registrar.php">Registar</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Funcionários
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="funcionarios.php">Consultar</a></li>
              <li><a class="dropdown-item" href="funcionarios_cadastrar.php">Cadastrar</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container py-3">