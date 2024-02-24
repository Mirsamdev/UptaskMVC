<?php 

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
  public static function login(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    }

    // Render a la vista
    $router->render('auth/login', [
        'titulo' => 'Iniciar Sesion'
    ]);
  }

  public static function logout() {
    echo "Desde logout";
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
    
    }

    $router->render('auth/olvide', [
      'titulo' => 'Recuperar Password',
      'alertas' => $alertas
    ]);
  }

  public static function reestablecer(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    }

    $router->render('auth/reestablecer', [
      'titulo' => 'Reestablecer Password'
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