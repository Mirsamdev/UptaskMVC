(function() {
  // Boton para mostrar el Modal de agregar Tarea
  const nuevaTareaBtn = document.querySelector('#agregar-tarea');
  nuevaTareaBtn.addEventListener('click', mostrarFormulario);

  function mostrarFormulario() {
    const modal = document.createElement('DIV');
    modal.classList.add('modal');
    modal.innerHTML = `
    <form class="formulario nueva-tarea">
    <legend>Añade una nueva tarea</legend>
    <div class="campo">
    <label>Tarea</label>
    <input
    type="text"
    name="tarea"
    placeholder="Añadir Tarea al Proyecto Actual"
    id="tarea"
    />
    </div>
    <div class="opciones">
    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea" />
    <button type="button" class="cerrar-modal">Cancelar</button>
    </div>
    </form>
    `;

    setTimeout(() => {
      const formulario = document.querySelector('.formulario');
      formulario.classList.add('animar');
    }, 0);

    modal.addEventListener('click', function(e) {
      e.preventDefault();

      if (e.target.classList.contains('cerrar-modal') || e.target.classList.contains('modal') ) {
        const formulario = document.querySelector('.formulario');
        formulario.classList.add('cerrar');
        setTimeout(() => {
           modal.remove();
        }, 400);
   } 
    })

    document.querySelector('body').appendChild(modal);
  }

})();