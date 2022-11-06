<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$reservationsList = $data["reservationsList"];

// Si hay algún mensaje de feedback, lo mostramos
// if (isset($data["info"])) {
//   echo "<div style='color:blue'>".$data["info"]."</div>";
// }

// if (isset($data["error"])) {
//   echo "<div style='color:red'>".$data["error"]."</div>";
// }

// echo "<form action='index.php'>
//         <input type='hidden' name='action' value='buscarLibros'>
//         <input type='text' name='textoBusqueda'>
//         <input type='submit' value='Buscar'>
//       </form><br>";

// Ahora, la tabla con los datos de los libros
echo "<h2>Reservas</h2>";
if (count($reservationsList) == 0) {
  echo "No hay datos";
} else {
  echo "<table class='table table-striped'>";
  echo "<tr>";
  echo "<th>Recurso</th>";
  echo "<th>Descrición</th>";
  echo "<th>Localización</th>";
  echo "<th>Imagen</th>";
  echo "<th>Nombre del usuario</th>";
  echo "<th>Día</th>";
  echo "<th>Hora de inicio</th>";
  echo "<th>Hora de fin</th>";
  echo "<th>Modificación</th>";
  echo "<th>Borrado</th>";
  echo "</tr>";
  foreach ($reservationsList as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->name . "</td>";
    echo "<td>" . $fila->description . "</td>";
    echo "<td>" . $fila->location . "</td>";
    echo "<td>" . $fila->image . "</td>";
    echo "<td>" . $fila->realname . "</td>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td>" . $fila->startTime . "</td>";
    echo "<td>" . $fila->endTime . "</td>";
    echo "<td><a href='index.php?controller=reservationsController&action=modifyResourcesForm&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><button  onclick='confirmarBorrado(" . $fila->id . ")'>Borrar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=reservationsController&action=reservationsForm'>Nueva reserva</a></p>";
?>

<script type="text/javascript">
  function confirmarBorrado(id){
    console.log(id);
    if (confirm("¿Seguro que desea eliminar este elemento?")) {
      window.location.href='index.php?controller=reservationsController&action=eraseResources&id=' + id;
    }
  }
</script>