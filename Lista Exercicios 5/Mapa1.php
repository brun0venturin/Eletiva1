<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Mapa 01</h1>
        <form method="post">
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <div class="row mb-3">

                    <div class="col">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome[]" class="form-control" required>
                    </div>

                    <div class="col">
                        <label class="form-label">Número</label>
                        <input type="text" name="numero[]" class="form-control" required>
                    </div>

                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomes = $_POST['nome'];
            $numeros = $_POST['numero'];

            $mapa = [];

            for ($i = 0; $i < count($nomes); $i++) {

                if (!array_key_exists($nomes[$i], $mapa) && !in_array($numeros[$i], $mapa)) {
                    $mapa[$nomes[$i]] = $numeros[$i];
                }
            }
            ksort($mapa);

            echo "Contatos:<br>";

            foreach ($mapa as $nome => $numero) {
                echo "$nome - $numero<br>";
            }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>