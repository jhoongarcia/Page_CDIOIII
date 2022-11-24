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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plata-si hay-Agricultor</title>
    <link rel="icon" href="img/icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="page.css">
</head>

<body>
    <div id="container-preloader">
        <div id="preloader"></div>
    </div>
    <div id="menu_btn">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="container">
        <nav id="nav_profile">
            <a href="agricultor.php"><img src="img/logo.svg" alt="Plata-si hay" class="logo"></a>
            <ul id="nav_ul">
                <li><a href="agricultor.php">
                        <span><i class="fa-solid fa-arrow-left"></i></span>
                        <span>Regresar</span>
                    </a></li>
                <hr>
                <li><a href="cerrarSesion.php">
                        <span><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span>Cerrar sesión</span>
                    </a></li>
            </ul>
        </nav>
        <hr>
        <section class="central">
            <div class="municipios">
                <h2>
                    <?php echo $user['Nombres']; ?>
                    <?php echo $user['Apellidos']; ?>
                </h2>
                <div class="photo" id="prof_photo">
                    <img src="img/user.png">
                </div>
            </div>
            <div class="publicaciones">
                <div class="information">
                    <div class="information-header">
                        <h2>Tu información</h2>
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
                    <div class="information-header">
                        <h2>Tus publicaciones</h2>
                    </div>
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
                                <div class="information-header" id="post-header">
                                    <h3><?php echo $rowUser['Nombres']; ?></h3>
                                    <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                </div>
                                <div class="body">
                                    <div class="switch">
                                        <label for="visible<?php echo $rowPublic['ID']; ?>"> <?php if ($rowPublic['visible']) { ?> <i class="fa-solid fa-eye-slash"></i> <?php } else { ?> <i class="fa-solid fa-eye"></i> <?php } ?> </label>
                                        <input type="checkbox" id="visible<?php echo $rowPublic['ID']; ?>" onchange="visibilidadpublicacion(<?php echo $rowPublic['ID']; ?>)" <?php echo $rowPublic['visible'] ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="datos">
                                        <div class="name">
                                            <p>Ubicación:</p>
                                            <?php echo $rowPublic['Ubicacion'] . ", " . $rowPublic['Municipio_Residencia']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Tipo:</p>
                                            <?php echo $rowPublic['Tipo_Platano']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Cantidad:</p>
                                            <?php echo $rowPublic['Cantidad_Producto']; ?>
                                        </div>
                                        <div class="name">
                                            <p>Precio:</p>
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
    <script>
        var loader = document.getElementById("container-preloader");
        var menu = document.getElementById("menu_btn")
        var nav_profile = document.getElementById("nav_profile")
        var nav_ul = document.getElementById("nav_ul")

        window.addEventListener("load", function() {
            loader.style.opacity = 0;
            loader.style.visibility = "hidden";
        })

        menu.addEventListener('click', () => {
            nav_ul.classList.toggle("show");
            nav_profile.classList.toggle("show");
        });
    </script>
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