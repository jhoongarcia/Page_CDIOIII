<?php
require 'conexion.php';

$message = '';

if ($_POST) {
    $Armenia = $_POST['Armenia'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'armenia', $Armenia, current_timestamp());");
    $precio->execute();

    $Buenavista = $_POST['Buenavista'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'buenavista', $Buenavista, current_timestamp());");
    $precio->execute();

    $Calarca = $_POST['Calarca'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'calarca', $Calarca, current_timestamp());");
    $precio->execute();

    $Circasia = $_POST['Circasia'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'circasia', $Circasia, current_timestamp());");
    $precio->execute();

    $Cordoba = $_POST['Cordoba'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'cordoba', $Cordoba, current_timestamp());");
    $precio->execute();

    $Filandia = $_POST['Filandia'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'filandia', $Filandia, current_timestamp());");
    $precio->execute();

    $Genova = $_POST['Genova'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'genova', $Genova, current_timestamp());");
    $precio->execute();

    $Tebaida = $_POST['Tebaida'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'tebaida', $Tebaida, current_timestamp());");
    $precio->execute();

    $Montenegro = $_POST['Montenegro'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'montenegro', $Montenegro, current_timestamp());");
    $precio->execute();

    $Pijao = $_POST['Pijao'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'pijao', $Pijao, current_timestamp());");
    $precio->execute();

    $Quimbaya = $_POST['Quimbaya'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'quimbaya', $Quimbaya, current_timestamp());");
    $precio->execute();

    $Salento = $_POST['Salento'];
    $precio = $conn->prepare("INSERT INTO `precioactual` (`id`, `municipio`, `precio`, `fecha`) VALUES (NULL, 'salento', $Salento, current_timestamp());");
    $precio->execute();



    // if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
    //     $records = $conn->prepare("SELECT * FROM registro WHERE correo = '$correo';");
    //     $records->execute();
    //     // $results = $records->fetch(PDO::FETCH_ASSOC);
    //     // print_r($results);
    //     if ($records->fetch(PDO::FETCH_ASSOC)) {
    //         echo "<script> alert('Correo existente') </script>";
    //     } else {
    //         $sql = "INSERT INTO `registro` (`id`, `nombre`, `apellido`, `correo`, `contrasena`) VALUES (NULL, '$nombre', '$apellido', '$correo', '$contrasena');";
    //         $stmt = $conn->prepare($sql);

    //         if ($stmt->execute()) {
    //             $message = 'Registro correcto';
    //         } else {
    //             $message = 'Error al registrar';
    //         }
    //     }
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>
</head>

<body>
    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form action="ingresarPrecio.php" method="post">
        Precio en Armenia: <input type="number" name="Armenia" id=""> <br>
        Precio en Buenavista: <input type="text" name="Buenavista" id=""> <br>
        Precio en Calarcá: <input type="text" name="Calarca" id=""> <br>
        Precio en Circasia: <input type="text" name="Circasia" id=""> <br>
        Precio en Córdoba: <input type="text" name="Cordoba" id=""> <br>
        Precio en Filandia: <input type="text" name="Filandia" id=""> <br>
        Precio en Génova: <input type="text" name="Genova" id=""> <br>
        Precio en Tebaida: <input type="text" name="Tebaida" id=""> <br>
        Precio en Montenegro: <input type="text" name="Montenegro" id=""> <br>
        Precio en Pijao: <input type="text" name="Pijao" id=""> <br>
        Precio en Quimbaya: <input type="text" name="Quimbaya" id=""> <br>
        Precio en Salento: <input type="text" name="Salento" id=""> <br>

        <button type="submit">Ingresar precio</button>
    </form>
</body>

</html>