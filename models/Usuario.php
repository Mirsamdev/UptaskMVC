<?php

namespace Model;

class Usuario extends ActiveRecord {
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];

  
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->password2 = $args['password2'] ?? '';
    $this->token = $args['token'] ?? '';
    $this->confirmado = $args['confirmado'] ?? '';
  }


  // public $id;
  // public $nombre;
  // public $email;
  // public $password;
  // public $token;
  // public $confirmado;

  // Validacion
  public function validarNuevaCuenta() {
    if(!$this->nombre) {
      self::$alertas['error'][] = 'El nombre del Cliente es Obligatorio';
    }

    if(!$this->email) {
      self::$alertas['error'][] = 'El email del Cliente es Obligatorio';
    }

    if(!$this->password) {
      self::$alertas['error'][] = 'El password del Cliente es Obligatorio';
    }

    elseif(strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
    }

    if($this->password !== $this->password2) {
      self::$alertas['error'][] = 'Los Password no Coinciden';
    }

    
    return self::$alertas;
  }
}