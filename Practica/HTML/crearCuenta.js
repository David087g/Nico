function validarFormulario(event) {
    var nombre = document.getElementById('nombre').value.trim();
    var telefono = document.getElementById('phone').value.trim();
    var correo = document.getElementById('email').value.trim();
    var contraseña = document.getElementById('contraseña').value.trim();

    if (nombre === '' || telefono === '' || correo === '' || contraseña === '') {
        alert('Por favor, ingresa todos los datos');
        event.preventDefault(); // Evitar el envío del formulario
        window.location.reload(); // Recargar la página actual
    } else {
        // Si no hay errores, redirigir a crearCuenta.php
        window.location.href = 'Bienvenido.html';
    }

}

// Asociar la función de validación al evento 'submit' del formulario
document.querySelector('form').addEventListener('submit', validarFormulario);

