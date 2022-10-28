<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$usersList = $data["showList"];

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
echo "<h2>Usuarios</h2>";
if (count($usersList) == 0) {
  echo "No hay datos";
} else {
  echo "<table>";
  foreach ($usersList as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->username . "</td>";
    echo "<td>" . $fila->password . "</td>";
    echo "<td>" . $fila->realname . "</td>";
    echo "<td>" . $fila->type . "</td>";
    echo "<td><a href='index.php?controller=usersController&action=modifyUsersForm&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><button  onclick='confirmarBorrado(" . $fila->id . ")'>Borrar</button></td>";    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=usersController&action=insertUsersForm'>Nuevo usuario</a></p>";
?>

<script type="text/javascript">
  function confirmarBorrado(id){
    if (confirm("¿Seguro que desea eliminar este elemento?")) {
      window.location.href='index.php?controller=usersController&action=eraseUsers&id=' + id;
    }
  }
</script>