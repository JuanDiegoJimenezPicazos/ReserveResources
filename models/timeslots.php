<?php

// MODELO DE LIBROS

include_once "model.php";

class TimeSlots extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "timeSlots";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado en la tabla de libros
    // public function getMaxId()
    // {
    //     $result = $this->db->dataQuery("SELECT MAX(id) AS lastTimeSlots FROM timeSlots");
    //     return $result[0]->ultimoIdLibro;
    // }

    // Inserta un libro. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($dayOfWeek, $startTime, $endTime)
    {
        return $this->db->dataManipulation("INSERT INTO timeSlots (dayOfWeek,startTime,endTime) 
        VALUES ('$dayOfWeek','$startTime', '$endTime')");
    }

    // Inserta los autores de un libro. Recibe el id del libro y la lista de ids de los autores en forma de array.
    // Devuelve el número de autores insertados con éxito (0 en caso de fallo).
    // public function insertAutores($idLibro, $autores)
    // {
    //     $correctos = 0;
    //     foreach ($autores as $idAutor) {
    //         $correctos += $this->db->dataManipulation("INSERT INTO resources(id) VALUES('$id')");
    //     }
    //     return $correctos;
    // }

    // Actualiza un libro (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $dayOfWeek, $startTime, $endTime)
    {
        $ok = $this->db->dataManipulation("UPDATE timeSlots SET
                                dayOfWeek = '$dayOfWeek',
                                startTime = '$startTime',
                                endTime = '$endTime'
                                WHERE id = '$id'");
        return $ok;
    }

    // // Busca un texto en las tablas de libros y autores. Devuelve un array de objetos con todos los libros
    // // que cumplen el criterio de búsqueda.
    // public function search($textoBusqueda)
    // {
    //     // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
    //     $result = $this->db->dataQuery("SELECT * FROM libros
	// 				                    INNER JOIN escriben ON libros.idLibro = escriben.idLibro
	// 				                    INNER JOIN personas ON escriben.idPersona = personas.idPersona
	// 				                    WHERE libros.titulo LIKE '%$textoBusqueda%'
	// 				                    OR libros.genero LIKE '%$textoBusqueda%'
	// 				                    OR personas.nombre LIKE '%$textoBusqueda%'
	// 				                    OR personas.apellido LIKE '%$textoBusqueda%'
	// 				                    ORDER BY libros.titulo");
    //     return $result;
    // }
}