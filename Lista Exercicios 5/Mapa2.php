<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-3">
        <h1>Mapa 02</h1>

        <form method="post">

            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="border p-3 mb-3">
                    <h5>Aluno <?= $i + 1 ?></h5>

                    <div class="mb-3">
                        <label class="form-label">Nome do aluno:</label>
                        <input type="text" name="nome[]" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Nota 1:</label>
                            <input type="number" step="0.01" name="nota1[]" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nota 2:</label>
                            <input type="number" step="0.01" name="nota2[]" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nota 3:</label>
                            <input type="number" step="0.01" name="nota3[]" class="form-control" required>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomes = $_POST["nome"];
            $nota1 = $_POST["nota1"];
            $nota2 = $_POST["nota2"];
            $nota3 = $_POST["nota3"];

            $mapa = [];

            for ($i = 0; $i < count($nomes); $i++) {

                $media = ($nota1[$i] + $nota2[$i] + $nota3[$i]) / 3;

                $mapa[$nomes[$i]] = $media;
            }

            arsort($mapa);

            echo "Resultados:<br>";

            foreach ($mapa as $nome => $media) {
                echo "$nome: ". number_format($media, 2),"<br>";
            }
        }
        ?>
    </div>
</body>

</html>