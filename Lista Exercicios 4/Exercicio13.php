<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 13</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 13</h1>
        <form method="post">
            <div class="mb-3">
                <label for="frase" class="form-label">Informe uma frase:</label>
                <input type="text" id="frase" name="frase" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $frase = $_POST['frase'];

            $palavras = explode(' ', trim($frase));

            $total = 0;
            $maior = "";

            foreach ($palavras as $p) {
                if ($p != "") {
                    $total++;
                    if (mb_strlen($p, 'UTF-8') > mb_strlen($maior, 'UTF-8')) {
                        $maior = $p;
                    }
                }
            }

            echo "Total de palavras: $total<br>";
            echo "Maior palavra: $maior<br>";
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>