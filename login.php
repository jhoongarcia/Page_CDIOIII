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
            header("Location:inicio.php");  
        } else {
            echo "<script> alert('correo o contraseña invalida') </script>";
        }
    }
}

?>