<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS
if ($data) {
    extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)
}


$lista = $data['todosLosRecursos'];

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.
if (isset($reservations)) {   
    echo "<h1>Modificación de reservas</h1>";
} else {
    echo "<h1>Inserción de reservas</h1>";
}

// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $reservations->id ?? ""; 
$name = $reservations->name ?? "";
$description = $reservations->description ?? "";
$location = $reservations->location ?? "";
$image = $reservations->image ?? "";
$realname = $reservations->image ?? "";
$dayOfWeek = $reservations->image ?? "";
$startTime = $reservations->image ?? "";
$endTime = $reservations->image ?? "";

// Creamos el formulario con los campos del libro

echo "<select>";
foreach($lista as $resource){
    echo '<option value="'.$resource->id.'">'.$resource->name.'</option>';
}
echo "</select>";
echo "<br/>";
echo "<input type='date'>";                       

// echo "<form enctype='multipart/form-data' action = 'index.php' method = 'POST'>
// <select id='cars'>
//   <option value=''>".$name."</option>
// </select>
//         <input type='hidden' name='id' value='".$id."'>
//         Nombre:<input type='text' name='name' value=''><br>
//         Descripción:<input type='text' name='description' value='".$description."'><br>
//         Localización:<input type='text' name='location' value='".$location."'><br>
//         Imagen:<input type='text' name='image'><br>
//         Nombre real:<input type='text' rrealname='location' value='".$realname."'><br>
//         Día:<input type='text' name='dayOfWeek' value='".$dayOfWeek."'><br>
//         Hora de inicio:<input type='text' name='startTime' value='".$startTime."'><br>
//         Hora de fin:<input type='text' name='endTime' value='".$endTime."'><br>";

// echo "Autores: <select name='autor[]' multiple size='3'>";
// foreach ($todosLosAutores as $fila) {
//     if (in_array($fila->idPersona, $autoresLibro))
//         echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
//     else
//         echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
// }
echo "</select>";

echo "<input type='hidden' name='controller' value='reservationsController'>";

// Finalizamos el formulario
if (isset($reservations)) {
    echo "  <input type='hidden' name='action' value='modifyReservations'>";
} else {
    echo "  <input type='hidden' name='action' value='insertReservations'>";
}
echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";