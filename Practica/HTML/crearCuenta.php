<?php
// Funciones de validación
function validarNombre($nombre) {
    // Solo letras y espacios permitidos en el nombre
    return preg_match("/^[a-zA-Z\s]*$/", $nombre);
}

function validarTelefono($telefono) {
    // Formato de teléfono válido (solo números)
    return preg_match("/^[0-9]{10}$/", $telefono);
}

function validarCorreo($correo) {
    // Formato de correo electrónico válido
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar variables para los mensajes de error
    $nombreError = $telefonoError = $correoError = "";

    // Validar el nombre
    if (empty($_POST["nombre"])) {
        $nombreError = "Nombre es requerido";
    } else {
        $nombre = $_POST["nombre"];
        if (!validarNombre($nombre)) {
            $nombreError = "Formato de nombre inválido";
        }
    }

    // Validar el teléfono
    if (empty($_POST["phone"])) {
        $telefonoError = "Teléfono es requerido";
    } else {
        $telefono = $_POST["phone"];
        if (!validarTelefono($telefono)) {
            $telefonoError = "Formato de teléfono inválido";
        }
    }

    // Validar el correo electrónico
    if (empty($_POST["email"])) {
        $correoError = "Correo electrónico es requerido";
    } else {
        $correo = $_POST["email"];
        if (!validarCorreo($correo)) {
            $correoError = "Formato de correo electrónico inválido";
        }
    }

    // Validar la contraseña
    if (empty($_POST["password"])) {
        $contraseñaError = "Contraseña es requerida";
    } else {
        $contraseña = $_POST["password"];
    }

    // Si hay algún error de validación, no continuar
    if (!empty($nombreError) || !empty($telefonoError) || !empty($correoError) || !empty($contraseñaError)) {
        echo "Por favor, corrige los errores del formulario: <br>";
        echo $nombreError . "<br>";
        echo $telefonoError . "<br>";
        echo $correoError . "<br>";
        echo $contraseñaError . "<br>";
        exit;
    }

    $Servidor = "localhost";
    $Usuario = "root";
    $Contraseña = "";
    $BaseDeDatos = "integradora";

    $enlace = mysqli_connect($Servidor, $Usuario, $Contraseña, $BaseDeDatos);

    // Verificar la conexión
    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    } 

    // Inserción de datos en la base de datos
    $insertarDatos = "INSERT INTO iniciodesesion (Usuario, Telefono, Correo, Contraseña) VALUES ('$nombre', '$telefono', '$correo', '$contraseña')";

    $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

    if ($ejecutarInsertar) {
        echo "Datos insertados correctamente.";
        header("Location: Bienvenido.html");
        exit;
    } else {
        echo "Error en la inserción: " . mysqli_error($enlace);
    }

    // Cerrar la conexión
    mysqli_close($enlace);
}
?>
