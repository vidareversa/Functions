<?php

class Funciones
{

  /** 
   * para usar en vez de mysqli_query (para extraer datos)
   */
  public function  mysqli_to_array($conexion, $sql, $primerRegistro = false)
  {
    $res = mysqli_query($conexion, $sql);
    $rows = array();
    if (is_object($res)) {
      if ($primerRegistro) { //true si solo devuelve un registro                   
        $rows = mysqli_fetch_assoc($res);
      } else {
        while ($row = mysqli_fetch_assoc($res)) {
          $rows[] = $row;
        }
      }
    }
    return $rows;
  }

  /**
   * Para buscar un dato en un array asociativo
   */
  public function in_asociative_array($array, $key, $key_value)
  {
    $within_array = false;
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        $within_array = in_asociative_array($v, $key, $key_value);
        if ($within_array == true) {
          break;
        }
      } else {
        if ($v == $key_value && $k == $key) {
          $within_array = true;
          break;
        }
      }
    }
    return $within_array;
  }
}

/* ejemplo de uso de in_asociative_array */

$trucomands[] = array(
  array('msgtext' => 'pepe', 'cantidad' => '2'),
  array('msgtext' => 'pepa', 'cantidad' => '5'),
  array('msgtext' => 'pipa', 'cantidad' => '1')
);

$f = new Funciones();
if ($f->in_asociative_array($trucomands, 'msgtext', 'pepe')) {
  return true;
} else {
  return false;
}
