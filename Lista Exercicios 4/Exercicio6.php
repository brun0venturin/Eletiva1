<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 06</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor" class="form-label">Informe um número:</label>
                <input type="number" id="num" name="num" step="any" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $num = $_POST["num"];
                $cima = ceil($num);
                $baixo = floor($num);   
                $normal = round($num);

                echo "Número original: $num<br>";
                echo "Arredondado para cima: $cima<br>";
                echo "Arredondado para baixo: $baixo<br>";
                echo "Arredondado normalmente: $normal";
            }
        
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>