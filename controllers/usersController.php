<?php

// CONTROLADOR DE LIBROS

include('models/users.php');
require_once('view.php');


class UsersController
{
    private $db;             // Conexión con la base de datos
    private $libro, $autor;  // Modelos

    public function __construct()
    {
        $this->users = new Users();
        
    }

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public function showList()
    {
       if (Seguridad::haySesion()) {
            $data["showList"] = $this->users->getAll();
            View::render("users/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- FORMULARIO ALTA DE LIBROS ----------------------------------------

    public function insertUsersForm()
        {
         if (Seguridad::haySesion()) {
    //         $data["todosLosAutores"] = $this->autor->getAll();
    //         $data["autoresLibro"] = array();  // Array vacío (el libro aún no tiene autores asignados)
            if (isset($data)) {
                View::render("users/form", $data);
            }else{
                View::render("users/form");
            }
             
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- INSERTAR LIBROS ----------------------------------------

    public function insertUsers()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $username = ($_REQUEST["username"]);
            $password = ($_REQUEST["password"]);
            $realname = ($_REQUEST["realname"]);
            $type = ($_REQUEST["type"]);

            $result = $this->users->insert($username, $password, $realname, $type);
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
            $data["showList"] = $this->users->getAll();
            View::render("users/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- BORRAR LIBROS ----------------------------------------

    public function eraseUsers()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id del libro que hay que borrar
            $id = ($_REQUEST["id"]);
            // Pedimos al modelo que intente borrar el libro
            $result = $this->users->delete($id);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Libro borrado con éxito";
            }
            $data["showList"] = $this->users->getAll();
            View::render("users/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- FORMULARIO MODIFICAR LIBROS ----------------------------------------

    public function modifyUsersForm()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del libro a modificar
            $data["users"] = $this->users->get($_REQUEST["id"])[0];
            // Renderizamos la vista de inserción de libros, pero enviándole los datos del libro recuperado.
            // Esa vista necesitará la lista de todos los autores y, además, la lista
            // de los autores de este libro en concreto.
            // $data["todosLosAutores"] = $this->autor->getAll();
            // $data["autoresLibro"] = $this->autor->getAutores(Seguridad::limpiar($_REQUEST["idLibro"]));
            View::render("users/form", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    // --------------------------------- MODIFICAR LIBROS ----------------------------------------

    public function modifyUsers()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $username = ($_REQUEST["username"]);
            $password = ($_REQUEST["password"]);
            $realname = ($_REQUEST["realname"]);
            $type = ($_REQUEST["type"]);
            $id = $_REQUEST["id"];

            // Pedimos al modelo que haga el update
            $result = $this->users->update($id, $username, $password, $realname, $type);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                // Si la modificación del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            $data["showList"] = $this->users->getAll();
            View::render("users/all", $data);
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

        // Muestra el formulario de login
        public function loginForm() {
            View::render("users/login");
        }
    
        // Comprueba los datos de login. Si son correctos, el modelo iniciará la sesión y
        // desde aquí se redirige a otra vista. Si no, nos devuelve al formulario de login.
        public function processLoginForm() {
            $username = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $result = $this->users->login($username, $password);
            if ($result) { 
                header("Location: index.php?controller=ResourcesController&action=showList");
            } else {
                $data["error"] = "Usuario o contraseña incorrectos";
                View::render("users/login", $data);
            }
        }
    
        // Cierra la sesión y nos lleva a la vista de login
        public function LogOut() {
            $this->users->LogOut();
            $data["info"] = "Sesión cerrada con éxito";
            View::render("users/login", $data);
        }
} // class