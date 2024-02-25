<div class="contenedor reestablecer">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>
  <div class="contenedor-sm">

  <?php include_once __DIR__ . '/../templates/alertas.php';?>

  <?php if($mostrar) { ?>

    <p class="descripcion-pagina">Coloca tu nuevo Password</p>

    <form class="formulario" method="POST">

      <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password">

      </div>

      <div class="campo">
        <label for="password2">Repetir Password</label>
        <input
            type="password"
            id="password2"
            placeholder="Repite Tu Password"
            name="password2"
            >
      </div>

      <input type="submit" class="boton" value="Guardar Password">
    </form>

  <?php } ?>

    <div class="acciones">
      <a href="/crear">¿Aún no tienes una cuenta? crea una</a>
      <a href="/">¿Ya Tienes una Cuenta? Inicia Sesion</a>
    </div>
  </div> <!-- contenedor sm -->
</div>
