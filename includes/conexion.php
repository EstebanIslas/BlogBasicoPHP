<?PHP

    /* Conexion a la base de datos*/
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'blog';
    
    $db = mysqli_connect($server, $username, $password, $database);

    mysqli_query($db, "SET NAMES 'uft8'");

    //Iniciar Session
    session_start();

?>