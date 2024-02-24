<?php 

namespace Controllers;

use MVC\Router;
use classes\Email;
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
          $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
          $email->enviarConfirmacion();

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

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    }

    $router->render('auth/olvide', [
      'titulo' => 'Recuperar Password'
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

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    }

    $router->render('auth/confirmar', [
      'titulo' => 'Confirmacion de Cuenta'
    ]);
  }
} 