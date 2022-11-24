<?php
require 'conexion.php';

$message = '';

if ($_POST) {
    $nombre = $_POST['name'];
    $apellido = $_POST['surname'];
    $correo = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];
    $municipio = $_POST['municipio'];
    $direccion = $_POST['direction'];
    $identificacion = $_POST['identification'];
    $celular = $_POST['phone'];

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare("SELECT * FROM registro_clientes WHERE Correo = '$correo';");
        $records->execute();
        // $results = $records->fetch(PDO::FETCH_ASSOC);

        if ( $records->fetch(PDO::FETCH_ASSOC)) {
            echo "<script> alert('Correo existente') </script>";
            header("location:login.php");
        } else {
            $sql = "INSERT INTO `registro_clientes` (`Idusuarios`, `Nombres`, `Apellidos`, `Correo`, `Contrasena`, `contra`, `Rol`, `Direccion`, `Municipio`, `Celular`) VALUES (NULL, '$nombre', '$apellido', '$correo', '$contrasena', '$contrasena', '$rol', '$direccion', '$municipio', '$celular');";
            $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            $message = 'Registro correcto';
            header("location:login.php");
        } else {
            $message = 'Error al registrar';
            header("location:login.php");
        }
        }        
    }
}
