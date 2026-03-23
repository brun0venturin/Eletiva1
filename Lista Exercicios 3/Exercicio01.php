<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 1</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 1</h1>
<form method="post">
<div class="mb-3">
              <label for="numero" class="form-label">Informe o primeiro número:</label>
              <input type="number" id="n1" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o segundo número:</label>
              <input type="number" id="n2" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o terceiro número:</label>
              <input type="number" id="n3" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o quarto número:</label>
              <input type="number" id="n4" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o quinto número:</label>
              <input type="number" id="n5" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o sexto número:</label>
              <input type="number" id="n6" name="numeros[]" class="form-control" required="">
              <label for="numero" class="form-label">Informe o sétimo número:</label>
              <input type="number" id="n7" name="numeros[]" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $numeros = $_POST["numeros"];

    $menor = $numeros[0];
    $posicao = 1;

    for ($i = 1; $i < 7; $i++) {
        if ($numeros[$i] < $menor) {
            $menor = $numeros[$i];
            $posicao = $i +1;
        }
    }
    echo "Menor valor: " . $menor . "<br>";
    echo "Posição do menor valor: " . $posicao;
 }

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>