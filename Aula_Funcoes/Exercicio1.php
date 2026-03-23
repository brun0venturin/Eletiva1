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
            <?php
            for($i=0;$i<7;$i++)
                echo '<div class="mb-3">
                    <label for="nota'.$i.'" class="form-label">Informe a nota</label>
                    <input type="text" id="nota'.$i.'" name="nota[]" class="form-control" required="">
                </div>';
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $mapa = $_POST['nota'];
                $copia_mapa = $mapa;
                sort($mapa);
                echo "<p>O menor valor é: ".$mapa[0]."</p>";
                $posicao = array_search($mapa[0], $copia_mapa);
                echo "<p>Na posição $posicao </p>";
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>