<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa 05</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-3">
        <h1>Mapa 05</h1>

        <form method="post">

            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="border p-3 mb-3">
                    <h5>Livro <?= $i + 1 ?></h5>

                    <div class="mb-3">
                        <label class="form-label">Título do livro:</label>
                        <input type="text" name="titulo[]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantidade em estoque:</label>
                        <input type="number" name="quantidade[]" class="form-control" required>
                    </div>
                </div>
            <?php
            }
            ?>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $titulos = $_POST["titulo"];
            $quantidades = $_POST["quantidade"];

            $mapa = [];

            $tamanho = count($titulos);

            for ($i = 0; $i < $tamanho; $i++) {

                $mapa[$titulos[$i]] = $quantidades[$i];
            }

            ksort($mapa);

            echo "Resultados:<br>";

            foreach ($mapa as $titulo => $quantidade) {

                echo "Título: ", $titulo, "<br>";
                echo "Quantidade: ", $quantidade, "<br>";

                if ($quantidade < 5) {
                    echo "<span style='color:red;'>Estoque baixo!</span><br>";
                }
                echo "<br>";
            }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>
</html>