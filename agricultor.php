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

if ($user['Rol'] == 0) {
    header("location:comerciante.php");
}

$sqlPrecio = $conn->prepare("SELECT * FROM precioactual ORDER BY id ASC;");
$sqlPrecio->execute();

while ($datosPrecio = $sqlPrecio->fetch()) {
    if ($datosPrecio['municipio'] == "armenia") {
        $precioArmenia[] = $datosPrecio['precio'];
        $fechaArmenia[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "buenavista") {
        $precioBuenavista[] = $datosPrecio['precio'];
        $fechaBuenavista[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "calarca") {
        $precioCalarca[] = $datosPrecio['precio'];
        $fechaCalarca[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "circasia") {
        $precioCircasia[] = $datosPrecio['precio'];
        $fechaCircasia[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "cordoba") {
        $precioCordoba[] = $datosPrecio['precio'];
        $fechaCordoba[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "filandia") {
        $precioFilandia[] = $datosPrecio['precio'];
        $fechaFilandia[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "genova") {
        $precioGenova[] = $datosPrecio['precio'];
        $fechaGenova[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "tebaida") {
        $precioTebaida[] = $datosPrecio['precio'];
        $fechaTebaida[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "montenegro") {
        $precioMontenegro[] = $datosPrecio['precio'];
        $fechaMontenegro[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "pijao") {
        $precioPijao[] = $datosPrecio['precio'];
        $fechaPijao[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "quimbaya") {
        $precioQuimbaya[] = $datosPrecio['precio'];
        $fechaQuimbaya[] = $datosPrecio['fecha'];
    }
    if ($datosPrecio['municipio'] == "salento") {
        $precioSalento[] = $datosPrecio['precio'];
        $fechaSalento[] = $datosPrecio['fecha'];
    }
}

if ($_POST && !empty($_POST['tipoPlatano'])) {
    $id_registro = $_SESSION['user_id'];
    $ubicacionFinca = $_POST['finca'];
    $tipoPlatano = $_POST['tipoPlatano'];
    $cantidadPlatano = $_POST['cantidadPlatano'];
    $precio = $_POST['precio'];
    $lugar = $_POST['lugar'];
    $contacto = $_POST['contacto'];
    $tiempoCosecha = $_POST['tiempoCosecha'];

    $sql = "INSERT INTO `publicación_platano_cliente` (`ID`, `Ubicacion`, `Municipio_Residencia`, `Cantidad_Producto`, `Tipo_Platano`, `Precio_Kilo`, `Contacto`, `Tiempo_Cosecha`, `IDagricultor`, `Fecha`, `visible`) VALUES (NULL, '$ubicacionFinca', '$lugar', '$cantidadPlatano', '$tipoPlatano', '$precio', '$contacto', '$tiempoCosecha', '$id_registro', current_timestamp(), '');";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        $message = 'Publicado';
        header("location:agricultor.php");
    } else {
        $message = 'Error al publicar';
    }
}

$masDatos = 0;
$search = 'todos';
$platano = 'todos';
// echo $search;
if (!empty($_POST['masDatos'])) {
    $masDatos = $_POST['masDatos'];
    $search = $_POST['search-muni'];
    $platano = $_POST['search-platano'];
    // echo $masDatos;
    // echo $search;
}

if (!empty($_POST['search'])) {
    $platano = $_POST['platano'];
}

if (!empty($_POST['filter'])) {
    $search = $_POST['filter'];
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
        <nav id="nav">
            <a href="agricultor.php"><img src="img/logo.svg" alt="Plata-si hay" class="logo"></a>
            <ul id="nav_ul">
                <li class="search">
                    <form action="agricultor.php" method="post">
                        <input id="toggle" type="checkbox" name="search">
                        <ul>
                            <li>
                                <label for="platano">Tipo de platano:</label>
                                <select name="platano" id="platano">
                                    <option value="todos" selected>Todos</option>
                                    <option value="Hartón">Hartón</option>
                                    <option value="Dominico hartón">Dominico Hartón</option>
                                    <option value="Dominico">Dominico</option>
                                </select>
                            </li>
                            <li>
                                <label for="search">Buscar</label>
                                <input type="text" id="search" name="filter">
                            </li>
                        </ul>
                        <label for="toggle"><i class="fas fa-search"></i></label>
                    </form>
                </li>
                <hr>
                <li class="link"><a href="#">Quienes somos</a></li>
                <hr>
                <li class="link"><a href="#">Contáctenos</a></li>
                <hr>
                <li class="link"><a href="#modal">Publicar</a></li>
                <hr>
                <li>
                    <details class="dropdown">
                        <summary>
                            <a>
                                <i class="fa-solid fa-circle-user"></i>
                                <?php echo $user['Nombres']; ?>
                                <?php echo $user['Apellidos']; ?>
                            </a>
                        </summary>
                        <ul>
                            <li><a href="profile.php">
                                    <span><i class="fa-solid fa-address-card"></i></span>
                                    <span>Perfil</span>
                                </a></li>
                            <li><a href="cerrarSesion.php">
                                    <span><i class="fa-solid fa-right-from-bracket"></i></span>
                                    <span>Cerrar sesión</span>
                                </a></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </nav>
        <hr>
        <section class="central">
            <div class="municipios">
                <h2>Municipios</h2>
                <ul>
                    <li><a href="#graphics-modal" onclick="cargarGraficaArmenia()">Armenia
                            <?php if (end($precioArmenia) > $precioArmenia[count($precioArmenia) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaBuenavista()">Buenavista
                            <?php if (end($precioBuenavista) > $precioBuenavista[count($precioBuenavista) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCalarca()">Calarcá
                            <?php if (end($precioCalarca) > $precioCalarca[count($precioCalarca) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCircasia()">Circasia
                            <?php if (end($precioCircasia) > $precioCircasia[count($precioCircasia) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCordoba()">Cordoba
                            <?php if (end($precioCordoba) > $precioCordoba[count($precioCordoba) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaFilandia()">Filandia
                            <?php if (end($precioFilandia) > $precioFilandia[count($precioFilandia) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaGenova()">Génova
                            <?php if (end($precioGenova) > $precioGenova[count($precioGenova) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaTebaida()">La tebaida
                            <?php if (end($precioTebaida) > $precioTebaida[count($precioTebaida) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaMontenegro()">Montenegro
                            <?php if (end($precioMontenegro) > $precioMontenegro[count($precioMontenegro) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaPijao()">Pijao
                            <?php if (end($precioPijao) > $precioPijao[count($precioPijao) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaQuimbaya()">Quimbaya
                            <?php if (end($precioQuimbaya) > $precioQuimbaya[count($precioQuimbaya) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaSalento()">Salento
                            <?php if (end($precioSalento) > $precioSalento[count($precioSalento) - 2]) { ?> <i class="fa-solid fa-arrow-trend-up"></i> <?php } else { ?> <i class="fa-solid fa-arrow-trend-down"></i> <?php } ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="publicaciones">
                <h2>Publicaciónes recientes</h2>
                <?php
                $sqlPub = $conn->prepare("SELECT * FROM publicación_platano_cliente ORDER BY id DESC;");
                $sqlPub->execute();
                $count = 0;

                // print_r($rowPublic);
                while ($rowPublic = $sqlPub->fetch()) {
                    // print_r($rowPublic);
                    if ($count == 5 && $masDatos == 0) {
                        break;
                    }

                    $idRegistro = $rowPublic['IDagricultor'];
                    $sqlUser = $conn->prepare("SELECT * FROM registro_clientes WHERE Idusuarios = '$idRegistro';");
                    $sqlUser->execute();
                    $rowUser = $sqlUser->fetch();
                    if ($rowPublic['visible'] == 0) {
                        $count = $count + 1;
                        // print_r($rowUser);
                        if (($search == $rowPublic['Municipio_Residencia']) and ($platano == $rowPublic['Tipo_Platano'])) {
                            if ($count % 2 != 0) {
                ?>
                                <div class="my-posts">
                                    <div class="posts">
                                        <div class="information-header">
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                        </div>
                                        <div class="body">
                                            <div class="photo">
                                                <img src="img/user.png">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                </div>
                                <br>
                            <?php
                            } elseif ($count % 2 == 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts right">
                                        <div class="information-header">
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                        </div>
                                        <div class="body">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                            <div class="photo-right">
                                                <img src="img/user.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                        } elseif ($search == 'todos' and $platano == 'todos') {
                            if ($count % 2 != 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts">
                                        <div class="information-header">
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                        </div>
                                        <div class="body">
                                            <div class="photo">
                                                <img src="img/user.png">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                </div>
                                <br>
                            <?php
                            } elseif ($count % 2 == 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts right">
                                        <div class="information-header">
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                        </div>
                                        <div class="body">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                            <div class="photo-right">
                                                <img src="img/user.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                        } elseif ($search == 'todos' and $platano == $rowPublic['Tipo_Platano']) {
                            if ($count % 2 != 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts">
                                        <div class="information-header">
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                        </div>
                                        <div class="body">
                                            <div class="photo">
                                                <img src="img/user.png">
                                            </div>
                                            <div class="name">
                                                    <p>Ubicación:</p>
                                                    <?php echo $rowPublic['Ubicacion'] . ", " . $rowPublic['Municipio_Residencia']; ?>
                                                </div>
                                                <div class="name">
                                                    <p>Tipo:</p>
                                                    <?php echo $rowPublic['Tipo_Platano']; ?>
                                                </div>
                                                <div class="name">
                                                    <p>Cantidad en Kilos:</p>
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
                                </div>
                                <br>
                            <?php
                            } elseif ($count % 2 == 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts right">
                                        <div class="information-header">
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                        </div>
                                        <div class="body">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                            <div class="photo-right">
                                                <img src="img/user.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                        } elseif ($search == $rowPublic['Municipio_Residencia'] and $platano == 'todos') {
                            if ($count % 2 != 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts">
                                        <div class="information-header">
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                        </div>
                                        <div class="body">
                                            <div class="photo">
                                                <img src="img/user.png">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                </div>
                                <br>
                            <?php
                            } elseif ($count % 2 == 0) {
                            ?>
                                <div class="my-posts">
                                    <div class="posts right">
                                        <div class="information-header">
                                            <h3><?php echo $rowPublic['Fecha']; ?></h3>
                                            <h3><?php echo $rowUser['Nombres']; ?></h3>
                                        </div>
                                        <div class="body">
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
                                                    <p>Cantidad en Kilos:</p>
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
                                            <div class="photo-right">
                                                <img src="img/user.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                <?php
                            }
                        }
                    }
                } ?>
                <form action="agricultor.php" method="post">
                    <input type="text" name="search-muni" id="search-muni" value=<?php echo $search; ?>>
                    <input type="text" name="search-platano" id="search-platano" value=<?php echo $platano; ?>>
                    <button type="submit" name="masDatos" value="1">Mostrar más Datos</button>
                </form>
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
    <div class="modal-wrapper" id="modal">
        <div class="modal-body card">
            <div class="modal-header">
                <h1 class="heading">Ingresa los datos de tu cosecha</h1>
                <a href="#!" role="button" class="close" aria-label="close this modal"><i class="fa-solid fa-xmark"></i></a>
                <!-- <p class="modal_description">Descripcion de lo que hace este modal</p> -->
            </div>
            <hr>
            <!-- <p class="modal_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore ducimus fugit eaque neque, consequatur ipsum mollitia ipsam temporibus reprehenderit a natus distinctio explicabo perspiciatis accusantium assumenda? Cumque quaerat voluptatibus neque.</p> -->
            <form action="agricultor.php" method="post">
                <input type="text" name="finca" placeholder="Ubicación de la finca">
                <select name="tipoPlatano" id="type_plat">
                    <option value="-1" disabled selected>Tipo de platano:</option>
                    <option value="Hartón">Hartón</option>
                    <option value="Dominico hartón">Dominico Hartón</option>
                    <option value="Dominico">Dominico</option>
                </select>
                <input type="text" name="cantidadPlatano" placeholder="Cantidad de Platano en kilo">
                <input type="text" name="precio" placeholder="Precio por kilo">
                <select name="lugar" id="lugar">
                    <option value="-1" disabled selected>Ubicación del producto</option>
                    <option value="armenia">Armenia</option>
                    <option value="buenavista">Buenavista</option>
                    <option value="calarca">Calarcá</option>
                    <option value="circasia">Circasia</option>
                    <option value="cordoba">Córdoba</option>
                    <option value="filandia">Filandia</option>
                    <option value="genova">Génova</option>
                    <option value="tebaida">La Tebaida</option>
                    <option value="montenegro">Montenegro</option>
                    <option value="pijao">Pijao</option>
                    <option value="quimbaya">Quimbaya</option>
                    <option value="salento">Salento</option>
                </select>
                <input type="text" name="contacto" placeholder="contacto">
                <button id="register" class="smt_form">Publicar</button>
            </form>
        </div>
        <a href="#!" class="outside-trigger"></a>
    </div>
    <div class="modal-wrapper" id="graphics-modal">
        <div class="modal-body card">
            <div class="modal-header">
                <h1 class="heading">Historial de precios</h1>
                <a href="#!" role="button" class="close" aria-label="close this modal"><i class="fa-solid fa-xmark"></i></a>
                <!-- <p class="modal_description">Descripcion de lo que hace este modal</p> -->
            </div>
            <hr>
            <!-- <p class="modal_text">Grafica para armenia.</p> -->
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <a href="#!" class="outside-trigger"></a>
    </div>

    <script>
        var loader = document.getElementById("container-preloader");
        var menu = document.getElementById("menu_btn")
        var nav = document.getElementById("nav")
        var nav_ul = document.getElementById("nav_ul")

        window.addEventListener("load", function() {
            loader.style.opacity = 0;
            loader.style.visibility = "hidden";
        })

        menu.addEventListener('click', () => {
            nav_ul.classList.toggle("show");
            nav.classList.toggle("show");
        });
    </script>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    var miCheckbox = document.getElementById('toggle');

    miCheckbox.addEventListener('click', function() {
        if (!miCheckbox.checked) {
            miCheckbox.type = "submit";
        } else {
            miCheckbox.type = 'checkbox';
        }
    });

    function cargarGraficaArmenia() {
        var datoPrecio = <?php echo json_encode($precioArmenia) ?>;
        var datoFecha = <?php echo json_encode($fechaArmenia) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Armenia');
    }

    function cargarGraficaBuenavista() {
        var datoPrecio = <?php echo json_encode($precioBuenavista) ?>;
        var datoFecha = <?php echo json_encode($fechaBuenavista) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Buenavista');
    }

    function cargarGraficaCalarca() {
        var datoPrecio = <?php echo json_encode($precioCalarca) ?>;
        var datoFecha = <?php echo json_encode($fechaCalarca) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Calarcá');
    }

    function cargarGraficaCircasia() {
        var datoPrecio = <?php echo json_encode($precioCircasia) ?>;
        var datoFecha = <?php echo json_encode($fechaCircasia) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Circasia');
    }

    function cargarGraficaCordoba() {
        var datoPrecio = <?php echo json_encode($precioCordoba) ?>;
        var datoFecha = <?php echo json_encode($fechaCordoba) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Córdoba');
    }

    function cargarGraficaFilandia() {
        var datoPrecio = <?php echo json_encode($precioFilandia) ?>;
        var datoFecha = <?php echo json_encode($fechaFilandia) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Filandia');
    }

    function cargarGraficaGenova() {
        var datoPrecio = <?php echo json_encode($precioGenova) ?>;
        var datoFecha = <?php echo json_encode($fechaGenova) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Génova');
    }

    function cargarGraficaTebaida() {
        var datoPrecio = <?php echo json_encode($precioTebaida) ?>;
        var datoFecha = <?php echo json_encode($fechaTebaida) ?>;
        crearGrafico(datoFecha, datoPrecio, 'La Tebaida');
    }

    function cargarGraficaMontenegro() {
        var datoPrecio = <?php echo json_encode($precioMontenegro) ?>;
        var datoFecha = <?php echo json_encode($fechaMontenegro) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Montenegro');
    }

    function cargarGraficaPijao() {
        var datoPrecio = <?php echo json_encode($precioPijao) ?>;
        var datoFecha = <?php echo json_encode($fechaPijao) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Pijao');
    }

    function cargarGraficaQuimabaya() {
        var datoPrecio = <?php echo json_encode($precioQuimbaya) ?>;
        var datoFecha = <?php echo json_encode($fechaQuimbaya) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Quimbaya');
    }

    function cargarGraficaSalento() {
        var datoPrecio = <?php echo json_encode($precioSalento) ?>;
        var datoFecha = <?php echo json_encode($fechaSalento) ?>;
        crearGrafico(datoFecha, datoPrecio, 'Salento');
    }

    function crearGrafico(datoFecha, datoPrecio, encabezado) {
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: datoFecha,
                datasets: [{
                    label: encabezado,
                    data: datoPrecio,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
</script>