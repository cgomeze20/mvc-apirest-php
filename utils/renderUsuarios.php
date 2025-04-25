<?php

function renderUsuarios($usuarios) {
    // Verificar si el array no está vacío
    if (empty($usuarios)) {
        return "<li>No hay usuarios disponibles.</li>";
    }

    // Inicializar la variable para almacenar la lista
    $lista = "<ul>\n";

    // Iterar sobre los usuarios
    foreach ($usuarios as $usuario) {
        $id =       htmlspecialchars($usuario["id"]);
        $nombre =   htmlspecialchars($usuario["nombre"]);
        $apellido = htmlspecialchars($usuario["apellido"]);
        $email =    htmlspecialchars($usuario["email"]);
        
        // Agregar cada usuario a la lista
        $lista .= "<li>{$id} *** {$nombre} *** {$apellido} *** {$email}</li>\n";
    }

    $lista .= "</ul>\n";
    return $lista;
}