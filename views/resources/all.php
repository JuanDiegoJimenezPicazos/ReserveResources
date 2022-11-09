<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$resourcesList = $data["resourcesList"];

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
echo "<h2>Recursos</h2>";
if (count($resourcesList) == 0) {
  echo "No hay datos";
} else {
  echo "<table class='table table-striped'>";
  echo "<tr>";
  echo "<th>Nombre</th>";
  echo "<th>Descripción</th>";
  echo "<th>Localización</th>";
  echo "<th>Imagen</th>";
  echo "<th>Modificación</th>";
  echo "<th>Borrado</th>";
  echo "</tr>";
  foreach ($resourcesList as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->name . "</td>";
    echo "<td>" . $fila->description . "</td>";
    echo "<td>" . $fila->location . "</td>";
    echo "<td><img src='" . $fila->image . "' width='200'></td>";
    echo "<td><a href='index.php?controller=resourcesController&action=modifyResourcesForm&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><button  onclick='confirmarBorrado(" . $fila->id . ")'>Borrar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=resourcesController&action=insertResourcesForm'>Nuevo recurso</a></p>";
?>

<script type="text/javascript">
  function confirmarBorrado(id){
    console.log(id);
    if (confirm("¿Seguro que desea eliminar este elemento?")) {
      window.location.href='index.php?controller=resourcesController&action=eraseResources&id=' + id;
    }
  }
</script>