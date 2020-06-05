<?php
    
    function mostrarError($errores, $campo){
        $alert = '';
        if (isset($errores[$campo]) && !empty($campo)) {
            $alert = "<div class='alert_error' style= 'color:red'>".$errores[$campo]."</div>";
        }
        return $alert;
    }

    function borrarErrores(){
        $eliminate = false;

        if (isset($_SESSION['completado'])) {

            $_SESSION['completado'] = null;
            $eliminate = session_unset();
        }

        if (isset($_SESSION['errores'])) {
            $_SESSION['errores'] = null;
            $eliminate = session_unset();
        }
        
        
        return $eliminate;
    }
?>