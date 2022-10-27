<?php
session_start();
require 'conexion.php';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $records = $conn->prepare("SELECT * FROM registro_clientes WHERE Idusuarios = '$id';");
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC);
} else {
    header("location:login.php");
}

$sqlPrecio = $conn->prepare("SELECT * FROM precioactual ORDER BY id ASC;");
$sqlPrecio->execute();
$dato = 1;

if (!empty($_GET['variable'])) {
    $idPublicacion = $_GET['variable'];
    $dat = $_GET['dato'];

    //echo $idPublicacion." ".$dat;
    if ($dat == 1) {
        $records = $conn->prepare("UPDATE `publicación_platano_cliente` SET `visible` = '$dat' WHERE `publicación_platano_cliente`.`ID` = '$idPublicacion';");
        $records->execute();
        header("Location:profile.php");
    } else {
        $records = $conn->prepare("UPDATE `publicación_platano_cliente` SET `visible` = '$dat' WHERE `publicación_platano_cliente`.`ID` = '$idPublicacion';");
        $records->execute();
        header("Location:profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plata-si hay-Agricultor</title>
    <link rel="icon" href="img/icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="page.css">
</head>

<body>
    <div class="container">
        <nav>
            <img src="img/logo.svg" alt="Plata-si hay" class="logo">
            <ul>
                <li class="icon"><a href="#"><i class="fas fa-search"></i></a></li>
                <li class="link"><a href="agricultor.php">Quienes somos</a></li>
                <hr>
                <li class="link"><a href="#">Contáctenos</a></li>
                <li class="icon"><a href="cerrarSesion.php"><i class="fa-solid fa-circle-user"></i></a></li>
            </ul>
        </nav>
        <hr>
        <section class="central">
            <div class="municipios">
                <h2>Tu nombre</h2>
                <div class="photo">
                    <!-- <img src="img/logo.png" alt=""> -->
                </div>
                <a href="#">Soy agricultor</a>
            </div>
            <div class="publicaciones">
                <div class="information">
                    <div class="information-header">
                        <h2>Tu información</h2>
                        <a href="#"><button type="button">Editar perfil</button></a>
                    </div>
                    <div class="information-body">
                        <div class="name">
                            <p>Nombres: </p>
                            <?php echo $user['Nombres']; ?>
                        </div>
                        <div class="name">
                            <p>Apellidos: </p>
                            <?php echo $user['Apellidos']; ?>
                        </div>
                        <div class="name">
                            <p>Correo: </p>
                            <?php echo $user['Correo']; ?>
                        </div>
                        <div class="name">
                            <p>Dirección: </p>
                            <?php echo $user['Direccion']; ?>
                        </div>
                        <div class="name">
                            <p>Municipio: </p>
                            <?php echo $user['Municipio']; ?>
                        </div>
                        <div class="name">
                            <p>Celular: </p>
                            <?php echo $user['Celular']; ?>
                        </div>
                    </div>
                </div>

                <div class="my-posts">
                    <h2>Tus Publicaciones</h2>
                    <?php
                    $sqlPub = $conn->prepare("SELECT * FROM publicación_platano_cliente ORDER BY id DESC;");
                    $sqlPub->execute();

                    // print_r($rowPublic);
                    while ($rowPublic = $sqlPub->fetch()) {
                        // print_r($rowPublic);
                        $idRegistro = $rowPublic['IDagricultor'];
                        $sqlUser = $conn->prepare("SELECT * FROM registro_clientes WHERE Idusuarios = '$idRegistro';");
                        $sqlUser->execute();
                        $rowUser = $sqlUser->fetch();
                        // print_r($rowUser);
                        if ($_SESSION['user_id'] == $rowUser['Idusuarios']) {
                    ?>
                            <div class="posts">
                                <!-- <div class="information-header">
                                    <h3><?php echo $rowUser['Nombres']; ?></h3>
                                    <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                </div> -->
                                <div class="body">
                                    <div class="switch">
                                        <label for="visible<?php echo $rowPublic['ID']; ?>"> <?php if ($rowPublic['visible']) { ?> <i class="fa-solid fa-eye-slash"></i> <?php }else{ ?> <i class="fa-solid fa-eye"></i> <?php } ?>  </label>
                                        <input type="checkbox" id="visible<?php echo $rowPublic['ID']; ?>" onchange="visibilidadpublicacion(<?php echo $rowPublic['ID']; ?>)" <?php echo $rowPublic['visible'] ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="datos">
                                        <div class="name">
                                            <p>Ubicación:</p>
                                            <?php echo $rowPublic['Ubicacion'] . ", " . $rowPublic['Municipio_Residencia']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Tipo de platano:</p>
                                            <?php echo $rowPublic['Tipo_Platano']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Cantidad de platano en Kilos:</p>
                                            <?php echo $rowPublic['Cantidad_Producto']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Precio por kilo:</p>
                                            <?php echo $rowPublic['Precio_Kilo']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Contacto:</p>
                                            <?php echo $rowPublic['Contacto']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                    <?php }
                    } ?>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="container">
            <div class="section about">
                <h2>Acerca de nosotros</h2>
                <p>
                    Somos un grupo de estudiantes de la Universidad del Quindío que buscan ayudar a reducir la desigualdad de precios que existen a la hora en que se realizan negociaciones entre agricultores y comerciantes del platano en el departamento del Quindío.
                </p>
                <ul class="sci">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="section quicklinks">
                <h2>Enlaces de interés</h2>
                <ul>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terminos y condiciones</a></li>
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div class="section contact">
                <h2>Contacto</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                        <span>Armenia, Quindío, 63000,<br>COL</span>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-phone" aria hidden="true"></i></span>
                        <p><a href="tel:1234578900">+57 3152841369</a>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
                        <p><a href="mailto:jasb@uqvirtual.edu.co">jasb@uqvirtual.ed.co</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <p>Copyright ©2022 JASB professionals. All rights Reserved.</p>
    </div>
</body>

</html>

<script>
    function visibilidadpublicacion(id) {
        var valor = id;
        //document.getElementById('caja_valor').value = valor;
        visible = document.getElementById('visible' + valor).checked;
        console.log(visible + "  " + valor);
        if (visible) {
            var dato = 1;
        } else {
            var dato = 0;
        }
        window.location = "profile.php?variable=" + valor + "&dato=" + dato;
    }
</script>