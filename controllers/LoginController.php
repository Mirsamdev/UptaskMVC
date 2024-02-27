<?php 

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
  public static function login(Router $router) {
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = new Usuario($_POST);

      $alertas = $usuario->validarLogin();

      if(empty($alertas)) {
        // Verificar que el usuario exista
        $usuario = Usuario::where('email', $usuario->email);

        if(!$usuario || !$usuario->confirmado) {
          Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
        } else {
          // El usuario existe
          if(password_verify($_POST['password'], $usuario->password) ) {

              // Iniciar la sesion
              session_start();
              $_SESSION['id'] = $usuario->id;
              $_SESSION['nombre'] = $usuario->nombre;
              $_SESSION['email'] = $usuario->email;
              $_SESSION['login'] = true;
              
              // Redireccionar
              header('Location: /dashboard');
          } else {
            Usuario::setAlerta('error', 'El password es incorrecto');
          }
        }
      }
    }
    $alertas = Usuario::getAlertas();

    // Render a la vista
    $router->render('auth/login', [
        'titulo' => 'Iniciar Sesion',
        'alertas' => $alertas
    ]);
  }

  public static function logout() {
    session_start();
    $_SESSION = [];
    header('Location: /');
  }

  public static function crear(Router $router) {
    $alertas = [];
    $usuario = new Usuario;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario->sincronizar($_POST);
        $alertas = $usuario->validarNuevaCuenta();

        if(empty($alertas)) {
            $existeUsuario = Usuario::where('email', $usuario->email);

            if($existeUsuario) {
                Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                $alertas = Usuario::getAlertas();
        } else {
          // Hashear el password
          $usuario->hashPassword();
          

          // Eliminar password2
          unset($usuario->password2);

          // Generar el Token
          $usuario->crearToken();

          // Crear un nuevo usuario
          $resultado = $usuario->guardar();

          // Enviar email
          $mail = new Email($usuario->email, $usuario->nombre, $usuario->token);
          $mail->enviarConfirmacion();

          if($resultado) {
            header('Location: /mensaje');
          }
        }
      }
     
    }

    // Render a la vista
    $router->render('auth/crear', [
      'titulo' => 'Crea tu cuenta en UpTask', 
            'usuario' => $usuario, 
            'alertas' => $alertas
  ]);
  }

  public static function olvide(Router $router) {
    $alertas = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = new Usuario($_POST);
      $alertas = $usuario->validarEmail();

      if(empty($alertas)) {
        $usuario = Usuario::where('email', $usuario->email);

        if($usuario && $usuario->confirmado) {

          // Generar un nuevo token
          $usuario->crearToken();
          unset($usuario->password2);
          
          // Actualizar el usuario
          $usuario->guardar();

          // Enviar el email
          $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
          $email->enviarInstrucciones();

          //Imprimir la alerta
          Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

        } else {
          Usuario::setAlerta('error', 'El usuario no existe');
        }
      }
    }

    $alertas = Usuario::getAlertas();

    $router->render('auth/olvide', [
      'titulo' => 'Recuperar Password',
      'alertas' => $alertas
    ]);
  }

  public static function reestablecer(Router $router) {

    $token = s($_GET['token']);
    $mostrar = true;

    if(!$token) header('Location: /');

    // Identificar el usuario con este token
    $usuario = Usuario::where('token', $token);

    if(empty($usuario)) {
        Usuario::setAlerta('error', 'Token No Válido');
        $mostrar = false;
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Añadir el nuevo password
        $usuario->sincronizar($_POST);

        // Validar el password
        $alertas = $usuario->validarPassword();

        if(empty($alertas)) {
            // Hashear el nuevo password
            $usuario->hashPassword();

            // Eliminar el Token
            $usuario->token = '';

            // Guardar el usuario en la BD
            $resultado = $usuario->guardar();

            // Redireccionar
            if($resultado) {
                          //Mostrar mensaje de éxito
              Usuario::setAlerta('exito', 'Password Actualizado Correctamente');
              
              //Redireccionar al inicio luego de 3seg
              header("Refresh: 3; url=/");
            }
        }
    }

    $alertas = Usuario::getAlertas();
    // Muestra la vista
    $router->render('auth/reestablecer', [
        'titulo' => 'Reestablecer Password',
        'alertas' => $alertas,
        'mostrar' => $mostrar
    ]);
}
  public static function mensaje(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    }

    $router->render('auth/mensaje', [
      'titulo' => 'Cuenta Creada Exitosamente'
    ]);
  }

  public static function confirmar(Router $router) {

   $token = s($_GET['token']);

   if(!$token) header('Location: /');

   // Encontrar al usuario con este token
   $usuario = Usuario::where('token', $token);

   if(empty($usuario)) {
    Usuario::setAlerta('error', 'Token No Valido');
   } else {
    // Confirmar la cuenta
    $usuario->confirmado = 1;
    $usuario->token = '';
    unset($usuario->password2);

    $usuario->guardar();

    Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
   }

   $alertas = Usuario::getAlertas();

    $router->render('auth/confirmar', [
      'titulo' => 'Confirmacion de Cuenta',
      'alertas' => $alertas 
    ]);
  }
} 