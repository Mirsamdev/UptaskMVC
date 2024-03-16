<aside class="sidebar">
  <div class="contenedor-sidebar">
    <h2>UpTask</h2>

  <div class="cerrar-menu">
      <img id="cerrar-menu" src="build/img/cerrar.svg" alt="imagen cerrar">
  </div>
  </div>
  

  <nav class="sidebar-nav">
    <li>

      <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyecto</a>
      <a class="<?php echo ($titulo === 'Crear proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyecto</a>
      <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>

    </li>
  </nav>

  <div class="cerrar-sesion-mobile">
    <a href="/logout" class="cerrar-sesion">Cerrar Sesion</a>
  </div>
</aside>