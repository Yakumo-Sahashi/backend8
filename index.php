


<?php
    use controller\Personas;
    require_once realpath('./vendor/autoload.php');

    #echo print_r(Personas::actualizar_datos());
    #echo print_r(Personas::eliminar_datos());
    echo print_r(Personas::obtener_datos());

    /* foreach(Personas::obtener_datos() as $datos){
        echo $datos['nombre'].'<br>';
        echo $datos['apellido'].'<br>';
        echo $datos['email'].'<br>';
        echo '*********************<br>';
    } */
?>