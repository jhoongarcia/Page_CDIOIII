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

if ($user['Rol'] == 1) {
    header("location:agricultor.php");
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
                <li class="link"><a href="#">Quienes somos</a></li>
                <hr>
                <li class="link"><a href="#">Contáctenos</a></li>
                <li class="icon"><a href="cerrarSesion.php"><i class="fa-solid fa-circle-user"></i></a></li>
            </ul>
        </nav>
        <hr>
        <section class="central">
            <div class="municipios">
                <h2>Municipios</h2>
                <ul>
                    <li><a href="#graphics-modal" onclick="cargarGraficaArmenia()">Armenia</a>
                        <span><i class="fa-solid fa-arrow-trend-down"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaBuenavista()">Buenavista</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCalarca()">Calarcá</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCircasia()">Circasia</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaCordoba()">Cordoba</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaFilandia()">Filandia</a>
                        <span><i class="fa-solid fa-arrow-trend-down"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaGenova()">Génova</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaTebaida()">La tebaida</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaMontenegro()">Montenegro</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaPijao()">Pijao</a>
                        <span><i class="fa-solid fa-arrow-trend-down"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaQuimbaya()">Quimbaya</a>
                        <span><i class="fa-solid fa-arrow-trend-down"></i></span>
                    </li>
                    <li><a href="#graphics-modal" onclick="cargarGraficaSalento()">Salento</a>
                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                    </li>
                </ul>
            </div>
            <div class="publicaciones">
                <h2>Publicaciones recientes</h2>
                <?php
                $sqlPub = $conn->prepare("SELECT * FROM comentario ORDER BY id DESC;");
                $sqlPub->execute();

                // print_r($rowPublic);
                while ($rowPublic = $sqlPub->fetch()) {
                    // print_r($rowPublic);
                    $idRegistro = $rowPublic['id_registro'];
                    $sqlUser = $conn->prepare("SELECT * FROM registro WHERE id = '$idRegistro';");
                    $sqlUser->execute();
                    $rowUser = $sqlUser->fetch();
                    // print_r($rowUser);
                ?>
                    <div>
                        <div><br><?php echo $rowUser['nombre']; ?></div>
                        <div>
                            <br> Tipo de platano: <?php echo $rowPublic['tipoPlatano']; ?>
                            <br> Cantidad de platano en kilos: <?php echo $rowPublic['cantidadPlatano']; ?>
                            <br> Precio por kilo: <?php echo $rowPublic['precio']; ?>
                            <br> Lugar: <?php echo $rowPublic['lugar']; ?>
                        </div>
                    </div>
                    <br>
                <?php } ?>
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
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
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