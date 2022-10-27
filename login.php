<?php
session_start();
include "conexion.php";

if ($_POST) {
    $correo = $_POST['email'];
    print_r($_POST);
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare("SELECT * FROM registro_clientes WHERE Correo = '$correo';");
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        //$message = '';
       // print_r($results);

        if (($results) && (password_verify($_POST['password'], $results['contra']))) {
            $_SESSION['user_id'] = $results['Idusuarios'];
            if ($results['Rol'] == 1) {
                header("Location:agricultor.php"); 
            } else {
                header("Location:comerciante.php"); 
            }
        } else {
            echo "<script> alert('correo o contraseña invalida') </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container step1" id="step1">
            <form action="registro.php" method="post">
                <!--Step1-->
                <div class="signUp paso1">
                    <h1>Crea tu cuenta</h1>
                    <input type="text" name="name" placeholder="Nombres" >
                    <input type="text" name="surname" placeholder="Apellidos" >
                    <input type="email" name="email" placeholder="Correo" >
                    <input type="password" name="password" placeholder="Contraseña" >
                    <button id="signUp1" class="fwd_btn">Siguiente</button>
                </div>

                <!--Step2-->
                <div class="signUp step2">
                    <h1>Crea tu cuenta</h1>
                    <select name="rol" id="Rol" >
                        <option value="-1" disabled selected>Elige tu Rol</option>
                        <option value="0">Comerciante</option>
                        <option value="1">Agricultor</option>
                    </select>
                    <select name="municipio" id="municipio" >
                        <option value="-1" disabled selected>Elige tu municipio</option>
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
                    <input type="text" name="direction" placeholder="Dirección" required>
                    <input type="text" name="identification" placeholder="No. Cédula" required>
                    <input type="text" name="phone" placeholder="No. Celular" required>
                    <div class="btns">
                        <button id="signUp2" class="bwd_btn"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                        <button id="register" class="smt_form">Registrarse</button>
                    </div>
                </div>
            </form>
        </div>

        <!--SigIn-->
        <div class="form-container sign-in-container">
            <form action="login.php" method="post">
                <h1>Iniciar Sesión</h1>
                <input type="email" name="email" placeholder="Correo" />
                <input type="password" name="password" placeholder="Contraseña" />
                <button>Ingresar</button>
            </form>
        </div>

        <!--Overlay-->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¿No tienes una cuenta?</h1>
                    <p>Que estas esperando, ingresa tu datos y creala en 2 sencillos pasos</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¿Ya tienes una cuenta?</h1>
                    <p>Ingresa ahora para ver las nuevas publicaciones</p>
                    <button class="ghost" id="signIn">ingresar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Copyright 2022
            <a target="_self" href="index.html">volver a la página principal</a>.
        </p>
    </footer>
    <script src="login.js"></script>
</body>
</html>