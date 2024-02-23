<?php 

namespace Controllers;

use MVC\Router;
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
    $usuario = new Usuario;
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario->sincronizar($_POST);

      $alertas = $usuario->validarNuevaCuenta();
      
    }

    // Render a la vista
    $router->render('auth/crear', [
      'titulo' => 'Crea Tu Cuenta en Uptask',
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