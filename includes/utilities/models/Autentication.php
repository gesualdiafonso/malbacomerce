<?php
class Autentication
{
    /**
     * Verifica las credenciales del usuario, y de ser correctas, guarda los datos en la sesión
     * @param string $user_name El nombre del usuario
     * @param string $password La contraseña del usuario
     * @return mixed Devuelve el rol en caso que las credenciales sean correctas, FALSE en caso de que no la sean y NUll en caso que el usuario no se encuentra en la BD.
     */
    public static function log_in(string $usuario, string $password)
    {
        $datosUsuario = Usuarios::usuario_username($usuario);
        // echo "<pre>";
        // print_r($datosUsuario);
        // echo "</pre>";

        if($datosUsuario){
            if(password_verify($password, $datosUsuario->getPassword())){

                $datosLogin['user_name'] = $datosUsuario->getUser_name();
                $datosLogin['name'] = $datosUsuario->getName();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['role'] = $datosUsuario->getRole();

                // Guardar los datos del usuario en la sesión
                $_SESSION['logged_in'] = $datosLogin;

                return $datosLogin['role']; // Devuelve el rol del usuario si la contraseña es correcta

            }else{
                Flags::add_flags('danger', "La contraseña ingresada no es correcta.");
                return false; // Contraseña incorrecta
            }
        }else{
            Flags::add_flags('warning', "El usuario ingresado no existe.");
            return null; // Usuario no encontrado
        }
    }

    public static function log_out()
    {
        if(isset($_SESSION['logged_in'])){
            // Eliminar los datos de la sesión
            unset($_SESSION['logged_in']);
            session_destroy(); // Destruye la sesión
            return true; // Logout exitoso
        } else {
            return false; // No hay sesión activa
        }
    }

    public static function verify($nivel = 0): bool
    {
        if(!$nivel){ //Restriccion nivel 0 - Acceso público
            return TRUE; // Acceso permitido
        }

        if (isset($_SESSION['logged_in'])){ // Restriccion nivel 1 - Acceso a usuarios logueados
            
            if($_SESSION['logged_in']['role'] == 'admin' || $_SESSION['logged_in']['role'] == 'superadmin'){
                return TRUE; // Acceso permitido para administradores y editores
            }  else {
                //Flags::add_flag('danger', "No tiene permisos para acceder a esta sección.");
                header('Location: ../index.php?section=login');
                return false; 
            }
        } else {
            header('Location: ../index.php?section=login'); // No hay sesión activa, acceso denegado
            return false; // Acceso denegado
        }
    }
}