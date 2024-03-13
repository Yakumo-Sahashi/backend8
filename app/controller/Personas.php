<?php
    namespace controller;
    use model\TablaPersona;
    require_once realpath('.../../vendor/autoload.php');

    class Personas{
        public static function obtener_datos(){
            $persona = new TablaPersona();
            return $persona->consulta()->where('nombre','test')->all();
        }

        public static function actualizar_datos(){
            $persona = new TablaPersona();
            return $persona->actualizar(['nombre'=>"testActual",'apellido'=>'testActual','email'=>'testActual@mail.com'])->where('id_persona','71')->get(); 
        }

        public static function eliminar_datos(){
            $persona = new TablaPersona();
            return $persona->eliminar()->where('id_persona','64')->get(); 
        }


    }
?>