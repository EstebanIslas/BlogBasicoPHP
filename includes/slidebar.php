<?php require_once"includes/helpers.php";?>

<!--Sidebar-->
<aside id="sidebar">
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario_logueado" class="bloque"> 
            <h3>Bienvenido, <?=$_SESSION['usuario']['nombre']?></h3>
        </div>
    <?php endif; ?>
    <div id="login" class="bloque">
        
        <h3>Inicia Sesión</h3>


        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alert-error"> 
            <?= "<div style= 'color:red'>".$_SESSION['error_login']."</div><br>";?>
            </div>
        <?php endif; ?>


        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password">

            <input type="submit" value="Ingresar">
        </form>
    </div>

    <div id="register" class="bloque">
        <h3>Registro</h3>

        <!--Mostrar Errores-->
        <?php if(isset($_SESSION['completado'])):?>
            <?= "<div style= 'color:green'>".$_SESSION['completado']."</div>";?>
        <?php elseif(isset($_SESSION['completado'])): ?>
            <?= "<div style= 'color:red'>".$_SESSION['errores']['generales']."</div>";?>
        <?php endif; ?>

        <form action="registro.php" method="POST">
            
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ;?>
            <!--Si la variable sesion esta vacia no se muestra nada en el view del index, caso contrario 
                llama a la funcion mostrarErrores del helper ya requerido-->
            
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ;?>

            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '' ;?>


            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '' ;?>


            <input type="submit" value="Registrar" name="submit">
        </form>
        <?php borrarErrores();?>
    </div>
</aside>