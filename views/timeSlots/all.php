<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$timeSlotsList = $data["showList"];

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
echo "<h2>Tramos horarios</h2>";
if (count($timeSlotsList) == 0) {
  echo "No hay datos";
} else {
  echo "<table>";
  foreach ($timeSlotsList as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td>" . $fila->startTime . "</td>";
    echo "<td>" . $fila->endTime . "</td>";
    echo "<td><a href='index.php?controller=timeSlotsController&action=modifyTimeSlotsForm&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><a href='index.php?controller=timeSlotsController&action=eraseTimeSlots&id=" . $fila->id . "'>Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=timeSlotsController&action=insertTimeSlotsForm'>Nuevo tramo horario</a></p>";