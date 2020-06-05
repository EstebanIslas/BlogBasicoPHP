<?php

    //Iniciar sesión y conexion a la db

    require_once "includes/conexion.php";

    //Recoger datos del formulario
    if (isset($_POST)) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        //Consulta para comprobar las credenciales del usuario
        $sql = "SELECT * FROM usuarios where email = '$email'";
        $login = mysqli_query($db, $sql);

        if ($login == true && mysqli_num_rows($login) == 1) { //Cuenta los campos y comprueba que sean correctos
            
            $usuario = mysqli_fetch_assoc($login); //devuelve el objeto de datos del usuario
            var_dump($usuario);
            
            $verify = password_verify($password, $usuario['password']);

            if ($verify == true) {
                //Utilizar sesion para guardar los datos
                $_SESSION['usuario'] = $usuario;

                if (isset($_SESSION['error_login'])) {
                    session_unset($_SESSION['error_login']);
                }
            }else {
                //Enviar sesion de fallido
                $_SESSION['error_login'] = 'Tu información no corresponde!';
            }
        }else {
            //Mensaje de error
            $_SESSION['error_login'] = 'Tu información no corresponde!';
        }

        
    }

    header("Location: index.php");

    //Comprobar la contraseña

    //Consulta a la bd para el acceso de usuario

    //Utilizar sesión para guardar datos del usuario logueado

    //Si hay una falla enviar una sesión con el fallo

    //Redirigir al index



?>