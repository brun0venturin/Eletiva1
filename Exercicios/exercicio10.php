<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 10</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 10</h1>
<form method="post">
<div class="mb-3">
              <label for="larguraret" class="form-label">Informe a largura do retângulo</label>
              <input type="number" id="larguraret" name="larguraret" class="form-control" required="">
            </div><div class="mb-3">
              <label for="alturaret" class="form-label">Informe a altura do retângulo</label>
              <input type="text" id="alturaret" name="alturaret" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $largura = $_POST["larguraret"];
        $altura = $_POST["alturaret"];
        $perimetro = ($largura + $altura) * 2;
        echo "O perímetro do retângulo é: $perimetro";

    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>