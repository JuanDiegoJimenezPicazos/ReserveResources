<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS
if ($data) {
    extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)
}

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.
if (isset($users)) {   
    echo "<h1>Modificación de recursos</h1>";
} else {
    echo "<h1>Inserción de recursos</h1>";
}

// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $users->id ?? ""; 
$username = $users->username ?? "";
$password = $users->password ?? "";
$realname = $users->realname ?? "";
$type = $users->type ?? "";

// Creamos el formulario con los campos del libro
echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='id' value='".$id."'>
        Nombre de usuario: <input type='text' name='username' value='".$username."'><br>
        Contraseña: <input type='password' name='password' value='".$password."'><br>
        Nombre real: <input type='text' name='realname' value='".$realname."'><br>
        Tipo admin o user: <input type='text' name='type' value='".$type."' placeholder='admin o user'><br>";


// echo "Autores: <select name='autor[]' multiple size='3'>";
// foreach ($todosLosAutores as $fila) {
//     if (in_array($fila->idPersona, $autoresLibro))
//         echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
//     else
//         echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
// }
//echo "</select>";

echo "<input type='hidden' name='controller' value='usersController'>";

// Finalizamos el formulario
if (isset($users)) {
    echo "  <input type='hidden' name='action' value='modifyUsers'>";
} else {
    echo "  <input type='hidden' name='action' value='insertUsers'>";
}
echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";