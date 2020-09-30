<?php
/* Clase para conectar y poder consultar a la BD */
class ejecutarSQL {
    public static function conectar(){
        if(!$con=  mysqli_connect(SERVER,USER,PASS,BD)){
            echo "Error en el servidor, verifique sus datos";
        }
        mysqli_set_charset($con, "utf8");   // Codificar la información de la base de datos a UTF8
        return $con;  
    }
    public static function consultar($query) {
        if (!$consul = mysqli_query(ejecutarSQL::conectar(), $query)) {
            echo 'Error en la consulta SQL ejecutada';
        }
        return $consul;
    }  
}
/* Clase para hacer las consultas Insertar, Eliminar, Actualizar y Limpiar */
class consultasSQL{

    // Función para Insertar
    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("INSERT INTO $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla");
        }
        return $consul;
    }

    // Función para Borrar
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("DELETE FROM $tabla WHERE $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla");
        }
        return $consul;
    }

    // Función para Actualizar
    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla");
        }
        return $consul;
    }

    // Función para Limpiar las cadenas de texto de los formularios
    public static function clean_string($val){
        $val=trim($val);                             // Elimina espacios
        $val=stripslashes($val);                     // Quita las barras con comillas escapadas
        $val=str_ireplace("<script>", "", $val);     // Reemplaza algunos valores por ""    (search,replace,subject)
        $val=str_ireplace("</script>", "", $val);   
        $val=str_ireplace("<script src", "", $val);
        $val=str_ireplace("<script type=", "", $val);
        $val=str_ireplace("SELECT * FROM", "", $val);
        $val=str_ireplace("DELETE FROM", "", $val);
        $val=str_ireplace("INSERT INTO", "", $val);
        $val=str_ireplace("--", "", $val);
        $val=str_ireplace("^", "", $val);
        $val=str_ireplace("[", "", $val);
        $val=str_ireplace("]", "", $val);
        $val=str_ireplace("==", "", $val);
        $val=str_ireplace(";", "", $val);
        return $val;
    }
}
