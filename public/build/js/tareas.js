!function(){!async function(){try{const e="/api/tareas?id="+o(),a=await fetch(e),n=await a.json(),{tareas:r}=n;r=n.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No Hay Tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const n={0:"Pendiente",1:"Completa"};e.forEach(r=>{const c=document.createElement("LI");c.dataset.tareaId=r.id,c.classList.add("tarea");const s=document.createElement("P");s.textContent=r.nombre;const d=document.createElement("DIV");d.classList.add("opciones");const i=document.createElement("BUTTON");i.classList.add("estado-tarea"),i.classList.add(""+n[r.estado].toLowerCase()),i.textContent=n[r.estado],i.dataset.estadoTarea=r.estado,i.ondblclick=function(){!function(n){const r="1"===n.estado?"0":"1";n.estado=r,async function(n){const{estado:r,id:c,nombre:s,proyectoId:d}=n,i=new FormData;i.append("id",c),i.append("nombre",s),i.append("estado",r),i.append("proyectoId",o());try{const o="http://localhost:3000/api/tarea/actualizar",n=await fetch(o,{method:"POST",body:i}),s=await n.json();"exito"===s.respuesta.tipo&&(a(s.respuesta.mensaje,s.respuesta.tipo,document.querySelector(".contenedor-nueva-tarea")),e=e.map(e=>(e.id===c&&(e.estado=r),e)),t())}catch(e){console.log(e)}}(n)}({...r})};const l=document.createElement("BUTTON");l.classList.add("eliminar-tarea"),l.dataset.idTarea=r.id,l.textContent="Eliminar",d.appendChild(i),d.appendChild(l),c.appendChild(s),c.appendChild(d);document.querySelector("#listado-tareas").appendChild(c),console.log(c)})}function a(e,t,a){const o=document.querySelector("alerta");o&&o.remove();const n=document.createElement("DIV");n.classList.add("alerta",t),n.textContent=e,a.parentElement.insertBefore(n,a.nextElementSibling),setTimeout(()=>{n.remove()},5e3)}function o(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){!function(){const n=document.createElement("DIV");n.classList.add("modal"),n.innerHTML='\n    <form class="formulario nueva-tarea">\n    <legend>Añade una nueva tarea</legend>\n    <div class="campo">\n    <label>Tarea</label>\n    <input\n    type="text"\n    name="tarea"\n    placeholder="Añadir Tarea al Proyecto Actual"\n    id="tarea"\n    />\n    </div>\n    <div class="opciones">\n    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea" />\n    <button type="button" class="cerrar-modal">Cancelar</button>\n    </div>\n    </form>\n    ;',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),n.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")||r.target.classList.contains("modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{n.remove()},400)}r.target.classList.contains("submit-nueva-tarea")&&function(){const n=document.querySelector("#tarea").value.trim();if(""===n)return void a("El nombre de la tarea es Obligatorio","error",document.querySelector(".formulario legend"));!async function(n){const r=new FormData;r.append("nombre",n),r.append("proyectoId",o());try{const o="http://localhost:3000/api/tarea",c=await fetch(o,{method:"POST",body:r}),s=await c.json();if(a(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove(),window.location.reload()},3e3);const o={id:String(s.id),nombre:n,estado:"0",proyectoId:s.proyectoId};e=[...e,o],t()}}catch(e){console.log(e)}}(n)}()})),document.querySelector(".dashboard").appendChild(n)}()}))}();