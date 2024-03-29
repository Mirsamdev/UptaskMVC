<div class="contenedor login">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>
  <div class="contenedor-sm">
  <?php include_once __DIR__ . '/../templates/alertas.php';?>
    <p class="descripcion-pagina">Iniciar Sesion</p>

    <form class="formulario" method="POST" action="/" novalidate>
      <div class="campo">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            placeholder="Tu email"
            name="email">
      </div>

      <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password">

      </div>

      <input type="submit" class="boton" value="Iniciar Sesion">
    </form>
    <div class="acciones">
      <a href="/crear">¿Aún no tienes una cuenta? crea una</a>
      <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
  </div> <!-- contenedor sm -->
</div>
