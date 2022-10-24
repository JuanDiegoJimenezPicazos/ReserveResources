<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS
if ($data) {
    extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)
}

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.
if (isset($timeSlots)) {   
    echo "<h1>Modificación de recursos</h1>";
} else {
    echo "<h1>Inserción de recursos</h1>";
}

// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $timeSlots->id ?? ""; 
$dayOfWeek = $timeSlots->dayOfWeek ?? "";
$startTime = $timeSlots->startTime ?? "";
$endTime = $timeSlots->endTime ?? "";

// Creamos el formulario con los campos del libro
echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='id' value='".$id."'>
        Día de la semana:<input type='text' name='dayOfWeek' value='".$dayOfWeek."'><br>
        Hora de comienzo:<input type='time' name='startTime' value='".$startTime."'><br>
        Hora de fin:<input type='time' name='endTime' value='".$endTime."'><br>";

        // <label for="days">Día de la semana:</label>
        // <select name="dayOfWeek" value='".$dayOfWeek."'>
        //   <option value="lunes">Lunes</option>
        //   <option value="martes">Martes</option>
        //   <option value="miercoles">Miercoles</option>
        //   <option value="jueves">Jueves</option>
        //   <option value="viernes">Viernes</option>
        // </select>


// echo "Autores: <select name='autor[]' multiple size='3'>";
// foreach ($todosLosAutores as $fila) {
//     if (in_array($fila->idPersona, $autoresLibro))
//         echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
//     else
//         echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
// }
//echo "</select>";

echo "<input type='hidden' name='controller' value='timeSlotsController'>";

// Finalizamos el formulario
if (isset($timeSlots)) {
    echo "  <input type='hidden' name='action' value='modifyTimeSlots'>";
} else {
    echo "  <input type='hidden' name='action' value='insertTimeSlots'>";
}
echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";