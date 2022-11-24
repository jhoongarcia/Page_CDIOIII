<?php
session_start();
require 'conexion.php';

$message = '';

if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
}

if ($_POST) {
    $id_registro = $_SESSION['user_id'];
    $tipoPlatano = $_POST['tipoPlatano'];
    $cantidadPlatano = $_POST['cantiadadPlatano'];
    $precio = $_POST['precio'];
    $lugar = $_POST['lugar'];

    $sql = "INSERT INTO `comentario` (`id`, `id_registro`, `cantidadPlatano`, `tipoPlatano`, `precio`, `lugar`) VALUES (NULL, '$id_registro', '$cantidadPlatano', '$tipoPlatano', '$precio', '$lugar');";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        $message = 'Publicado';
    } else {
        $message = 'Error al publicar';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>publicar</title>
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-4    ,offset-md-4  ">

            </div>
            <div class="col-4    ,offset-md-4  ">

                <div class="card">
                    <div class="card-header">
                        Publica tu producción
                    </div>

                    <div class="card-body">
                        <form action="comentar.php" method="post">
                            Tipo de platano: <input class="form-control" type="text" name="tipoPlatano" id="">
                            <br>
                            Cantidad de platano en kilos: <input class="form-control" type="text" name="cantiadadPlatano" id="">
                            <br>
                            Precio por kilo: <input class="form-control" type="interge" name="precio" id="">
                            <br>
                            Lugar: <input class="form-control" type="text" name="lugar" id="">
                            <br>
                            <button class="btn btn-success" type="submit">Publicar</button>
                            
                        </form>
                        <a href="inicio.php">Volver</a>
                    </div>

                    <div class="card-footer text-muted">

                    </div>
                </div>
            </div>
            <div class="col-4    ,offset-md-4  ">

            </div>
        </div>
    </div>
</body>

</html>