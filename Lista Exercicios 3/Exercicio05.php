<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 5</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 5</h1>
<form method="post">
<div class="mb-3">
              <label for="mes" class="form-label">Informe um número de 1 a 12 para saber o mês correspondente.</label>
              <input type="number" id="mes" name="mes" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $mes = $_POST["mes"];

    switch($mes){ 
        
        case 1:
            echo "1 = Janeiro";
            break;
        case 2:
            echo "2 = Fevereiro";
            break;
        case 3:
            echo "3 = Março";
            break;
        case 4:
            echo "4 = Abril";
            break;
        case 5:
            echo "5 = Maio";
            break;
        case 6:
            echo "6 = Junho";
            break;
        case 7:
            echo "7 = Julho";
            break;
        case 8:
            echo "8 = Agosto";
            break;
        case 9:
            echo "9 = Setembro";
            break;
        case 10:
            echo "10 = Outubro";
            break;
        case 11:
            echo "11 = Novembro";
            break;
        case 12:
            echo "12 = Dezembro";
            break;
        default:
            echo "inválido";
    }
 }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>