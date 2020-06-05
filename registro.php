<?php
    if (isset($_POST)) {

        require_once 'includes/conexion.php'; //Connect to database

        if (!isset($_SESSION)) {
            session_start();
        }

        //Evaluar con operadores ternarios en caso de estar vacios

        //mysqli_real_escape_string($parametro_variable_base_datos, $_POST['Variable a ingresar']) //Asegura datos en un formulario y evita inyecciones string
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false; //trim funciona para guardar datos sin espacio
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']): false;

        //Array de errores

        $errores = array();

        //Validar antes de guardar

        // Validar nombre

        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            $validate_name = true;
            echo 'El nombre es valido';
        }else{
            $validate_name = false;
            $errores['nombre'] = "El nombre no es valido";
        }
        // Validar apellidos

        if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
            $validate_apellidos = true;
            echo 'El apellido es valido';
        }else{
            $validate_apellidos = false;
            $errores['apellidos'] = "El apellido no es valido";
        }

        // Validar email

        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validate_email = true;
            echo 'El email es valido';
        }else{
            $validate_email = false;
            $errores['email'] = "El email no es valido";
        }

        //Validar Contraseña
        if (!empty($password) && strlen($password) >= 5) {
            $validate_pass = true;
            echo 'El password es valido';
        }else{
            $validate_pass = false;
            $errores['password'] = "La contraseña esta vacía o se requieren 5 caracteres";
        }

        $create_usuario = false;

        if (count($errores) == 0) {
            //Inserta los datos en la BD
            $create_usuario = true;

            /*Cifrado de información indica un has a la pass original y posterior
              Costea las veces que le indiquemos a la contraseña
            */
            $password_save = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            
            //password_verify($password, $password_segura); //Verificar si la contraseña coincide

            $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_save', CURRENT_TIMESTAMP)";

            $query = mysqli_query($db, $sql); //Insertar consulta sql

            // mysqli_error($db); //Funciona para ver los errores existentes
            if ($query == true) {
                $_SESSION['completado'] = 'Usuario Registrado Correctamente';
            }else {
                $_SESSION['errores']['generales'] = 'Fallo al registrar usuario';
            }



        }else{
            $create_usuario = false;
            $_SESSION['errores'] = $errores;
        }
    }

    header('Location: index.php');


?>