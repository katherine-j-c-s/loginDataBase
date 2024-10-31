<?php
class Session {
    public function __construct() {
        // Inicia la sesión
        session_start();
    }

    public function iniciar($nombreUsuario, $psw) {
        // Aquí deberías validar el usuario y la contraseña, por ejemplo, con una base de datos.
        // Por simplicidad, asumimos que la validación es exitosa.

        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['psw'] = $psw; // Normalmente no deberías almacenar la contraseña en la sesión.
        $_SESSION['rol'] = 'usuario'; // Ejemplo de rol asignado.
    }

    public function validar() {
        // Valida si el usuario y la contraseña son válidos.
        // Aquí deberías agregar la lógica de validación real.
        return isset($_SESSION['usuario']) && isset($_SESSION['psw']);
    }

    public function activa() {
        // Devuelve true si la sesión está activa
        return isset($_SESSION['usuario']);
    }

    public function getUsuario() {
        // Devuelve el usuario logueado
        return $this->activa() ? $_SESSION['usuario'] : null;
    }

    public function getRol() {
        // Devuelve el rol del usuario logueado
        return $this->activa() ? $_SESSION['rol'] : null;
    }

    public function cerrar() {
        // Cierra la sesión actual
        session_unset(); // Elimina las variables de sesión
        session_destroy(); // Destruye la sesión
    }
}
?>
