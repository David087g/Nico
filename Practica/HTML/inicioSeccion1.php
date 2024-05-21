<?php
// Conexión a la base de datos
$Servidor = "localhost";
$Usuario = "root";
$Contraseña = "";
$BaseDeDatos = "integradora";

$enlace = mysqli_connect($Servidor, $Usuario, $Contraseña, $BaseDeDatos);

// Verificar si la conexión fue exitosa
if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];

    // Validar los datos ingresados
    if (!empty($correo) && !empty($contraseña)) {
        // Protegerse contra inyecciones SQL
        $correo = mysqli_real_escape_string($enlace, $correo);
        $contraseña = mysqli_real_escape_string($enlace, $contraseña);

        // Consulta para verificar las credenciales del usuario
        $consulta = "SELECT * FROM iniciodesesion WHERE Correo = '$correo' AND Contraseña = '$contraseña'";
        $resultado = mysqli_query($enlace, $consulta);

        // Verificar si se encontró algún resultado
        if (mysqli_num_rows($resultado) > 0) {
            // Usuario encontrado
            // Redirigir a la página de bienvenida o dashboard
            header("Location: Bienvenido.html");
            exit;
        } else {
            // Usuario no encontrado
            header("Location: inicioSeccion1.html?error=Correo o contraseña incorrectos.");
            exit;
        }
    } else {
        // Datos faltantes
        header("Location: inicioSeccion1.html?error=Correo o contraseña incorrectos.");
exit;
    }
}

// Cerrar la conexión
mysqli_close($enlace);
?>
