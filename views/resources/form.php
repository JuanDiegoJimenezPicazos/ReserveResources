<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS
if ($data) {
    extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)
}

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.
if (isset($resources)) {   
    echo "<h1>Modificación de recursos</h1>";
} else {
    echo "<h1>Inserción de recursos</h1>";
}

// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $resources->id ?? ""; 
$name = $resources->name ?? "";
$description = $resources->description ?? "";
$location = $resources->location ?? "";
$image = $resources->image ?? "";

// Creamos el formulario con los campos del libro
echo "<form enctype='multipart/form-data' action = 'index.php' method = 'POST'>
        <input type='hidden' name='id' value='".$id."'>
        Nombre: <input type='text' name='name' value='".$name."'><br>
        Descripción: <input type='text' name='description' value='".$description."'><br>
        Localización: <input type='text' name='location' value='".$location."'><br>
        Imagen: <input type='text' name='image' id='image'><br>";

        // $ruta_fichero_origen = $_FILES['imagen1']['tmp_name'];
        // $ruta_nuevo_destino = $ruta_indexphp . '/images/' . $_FILES['imagen1']['name'];

        // $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        // if ( in_array($_FILES['imagen1']['type'], $extensiones) ) {
        //     echo 'Es una imagen';
        //     if(!move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino)) {
        //         echo 'Error al guardar el fichero';
        //     }
        // }


// echo "Autores: <select name='autor[]' multiple size='3'>";
// foreach ($todosLosAutores as $fila) {
//     if (in_array($fila->idPersona, $autoresLibro))
//         echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
//     else
//         echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
// }
// echo "</select>";

echo "<input type='hidden' name='controller' value='resourcesController'>";

// Finalizamos el formulario
if (isset($resources)) {
    echo "  <input type='hidden' name='action' value='modifyResources'>";
} else {
    echo "  <input type='hidden' name='action' value='insertResources'>";
}
echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";