<?php

// CONTROLADOR DE LIBROS

include('models/reservations.php');
require_once('view.php');


class ReservationsController
{
    private $db;             // Conexión con la base de datos
    private $libro, $autor;  // Modelos

    public function __construct()
    {
        $this->reservations = new Reservations();
        $this->resources = new Resources();
        
    }

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public function showList()
    {
       if (Seguridad::haySesion()) {
            $data["reservationsList"] = $this->reservations->multiTable();
            View::render("reservations/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- FORMULARIO ALTA DE LIBROS ----------------------------------------

    public function reservationsForm()
        {
        if (Seguridad::haySesion()) {
            $data["todosLosRecursos"] = $this->resources->getAll();
            // $data["autoresLibro"] = array();  // Array vacío (el libro aún no tiene autores asignados)
            if (isset($data)) {
                View::render("reservations/form", $data);
            }else{
                View::render("reservations/form");
            }
             
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- INSERTAR LIBROS ----------------------------------------

    public function insertReservations()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $name = ($_REQUEST["name"]);
            $description = ($_REQUEST["description"]);
            $location = ($_REQUEST["location"]);
            $image = ($_REQUEST["image"]);

            $result = $this->reservations->insert($name, $description, $location, $image);
            // if ($result == 1) {
            //     // Si la inserción del libro ha funcionado, continuamos insertando los autores, pero
            //     // necesitamos conocer el id del libro que acabamos de insertar
            //     $idLibro = $this->libro->getMaxId();
            //     // Ya podemos insertar todos los autores junto con el libro en "escriben"
            //     $result = $this->libro->insertAutores($idLibro, $autores);
            //     if ($result > 0) {
            //         $data["info"] = "Libro insertado con éxito";
            //     } else {
            //         $data["error"] = "Error al insertar los autores del libro";
            //     }
            // } else {
            //     // Si la inserción del libro ha fallado, mostramos mensaje de error
            //     $data["error"] = "Error al insertar el libro";
            // }
            $data["reservationsList"] = $this->reservations->getAll();
            View::render("reservations/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- BORRAR LIBROS ----------------------------------------

    public function eraseReservations()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id del libro que hay que borrar
            $id = ($_REQUEST["id"]);
            // Pedimos al modelo que intente borrar el libro
            $result = $this->reservations->delete($id);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Libro borrado con éxito";
            }
            $data["reservationsList"] = $this->reservations->getAll();
            View::render("reservations/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- FORMULARIO MODIFICAR LIBROS ----------------------------------------

    public function modifyReservationsForm()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del libro a modificar
            $data["reservations"] = $this->reservations->get($_REQUEST["id"])[0];
            // Renderizamos la vista de inserción de libros, pero enviándole los datos del libro recuperado.
            // Esa vista necesitará la lista de todos los autores y, además, la lista
            // de los autores de este libro en concreto.
            // $data["todosLosAutores"] = $this->autor->getAll();
            // $data["autoresLibro"] = $this->autor->getAutores(Seguridad::limpiar($_REQUEST["idLibro"]));
            View::render("reservations/form", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- MODIFICAR LIBROS ----------------------------------------

    public function modifyReservations()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $name = ($_REQUEST["name"]);
            $description = ($_REQUEST["description"]);
            $location = ($_REQUEST["location"]);
            $image = ($_REQUEST["image"]);
            $id = $_REQUEST["id"];

            // Pedimos al modelo que haga el update
            $result = $this->reservations->update($id, $name, $description, $location, $image);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                // Si la modificación del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            $data["reservationsList"] = $this->reservations->getAll();
            View::render("reservations/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- BUSCAR LIBROS ----------------------------------------

    // public function buscarLibros()
    // {
    //     if (Seguridad::haySesion()) {
    //         // Recuperamos el texto de búsqueda de la variable de formulario
    //         $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
    //         // Buscamos los libros que coinciden con la búsqueda
    //         $data["listaLibros"] = $this->libro->search($textoBusqueda);
    //         $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
    //         // Mostramos el resultado en la misma vista que la lista completa de libros
    //         View::render("libro/all", $data);
    //     } else {
    //         $data["error"] = "No tienes permiso para eso";
    //         View::render("usuario/login", $data);
    //     }
    // }
    


    // -------- LA APLICACIÓN CONTINUARÍA DESARROLLÁNDOSE AÑADIENDO FUNCIONES AQUÍ ------------------------

} // class