<div class="contenedor olvide">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>
  <div class="contenedor-sm">
  <?php include_once __DIR__ . '/../templates/alertas.php';?>
    <p class="descripcion-pagina">Recupera Tu Password</p>

    <form class="formulario" method="POST" action="/olvide" novalidate>
      <div class="campo">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            placeholder="Tu email"
            name="email">
      </div>

      <input type="submit" class="boton" value="Enviar Instrucciones">
    </form>
    <div class="acciones">
      <a href="/">¿Ya Tienes una Cuenta? Inicia Sesion</a>
      <a href="/crear">¿No tienes una cuenta? crea una</a>
    </div>
  </div> <!-- contenedor sm -->
</div>
