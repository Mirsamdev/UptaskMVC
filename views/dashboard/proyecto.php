<?php include_once __DIR__ . '/../dashboard/header-dashboard.php';  ?>

<div class="contenedor-sm">
  <div class="contenedor-nueva-tarea">
    <button
      type="button"
      class="agregar-tarea"
      id="agregar-tarea"
      >&#43;Nueva Tarea</button>
  </div>
</div>

<?php include_once __DIR__ . '/../dashboard/header-footer.php';  ?>

<?php
 $script = '
 <script src="build/js/tareas.js"></script>;
 <script src="build/js/app.js"></script>
 ';
 ?>