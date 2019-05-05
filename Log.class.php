<?php
class Log
{
   /* ***************************
    --------About / Acerca de ----------
    -Licence/Licencia: GPL (Usar, Compartir, Estudiar y Modificar libremente esta clase) 
    -Author/Autor: Facundo Giardino 
    -IMPORTANTE: Modificar el $path y el $pathMovs, el directorio donde quieras que se generan los logs (errores) y los movs (movimientos)
    ************************* */
  private $path;  
  private $pathMovs;

  public function __construct() 
  {
      $this->path = getcwd()."\errores\\"; //MODIFICAR  EL DIRECTORIO DONDE SE GENEREN LOS LOGS
      $this->pathMovs = getcwd()."\movimientos\\"; //MODIFICAR EL DIRECTORIO DONDE SE GENEREN LOS MOVIMIENTOS  
  }

  //setea el directorio de los errores
  public function setPath($directorio)
  {
      $this->path = $directorio;
  }

  //Retorna el string del directorio donde se encuentra la carpeta q contendra a los logs, (lo usa -devuelveNombreLogActual-)
  public function getPath()
  {
    	return $this->path;
  }

  //setea el directorio de los movimientos
  public function setPathMovs($directorio)
  {
      $this->pathMovs = $directorio;
  }
  
  public function getPathMovs()
  {
      return $this->pathMovs;    
  }


  //-----------------------ERRORES----------------------//
  // ingresa un mensaje en el Log de Errores
  public  function generarLog($mensaje)
  {
	if(!empty($mensaje) && $mensaje != NULL) {
		
		$nombreLog = self::devuelveNombreLogActual();
		$log = fopen("$nombreLog",'a');
		fwrite($log,"[Fecha: ".date("d-M-Y")."] [Hora: ".date('H:m:s')."][Error]:  $mensaje \r\n"); //dar un salto en linea para mostrarlo en el HTML
		fclose($log);  

	}  else  {
      		echo "<script>alert('Mensaje del log Vacio, REVISAR!');</script>"; //sirve para el testing...
  	}
  } 


  //muestra el Log de Errores en una tabla separando linea a linea ($cantidad = cantidad de lineas a mostrar)
  public static function mostrarLog($cantidad)
  { 
         $errores = file_get_contents(self::devuelveNombreLogActual());
         $array = explode("\n", $errores);
         $i = count($array)-2; // - 2 ya que el ultimo elemento siempre sera un salto de linea 
         
         if($cantidad > count($array))
         {
           $cantidad = count($array)-1;
         }

         echo "<table border='1' align='center' width='1000px'>";
         while($i > (count($array)-2-$cantidad)) //le resto - 2 ya que son las lineas perdidas
         {
            echo  "<tr><td>";
            echo  $array[$i];
            echo  "</td></tr>";        
            $i--;
         }
         echo "</table>";   
  }
 
  //genera un nombre de Log con el path, "log" y la fecha actual (se genera uno por dia)
  public static function devuelveNombreLogActual()
  {
	$objeto = new Log();
 	$nombre = $objeto->getPath(); 
	$nombre .= "log";
	$nombre .= date('dmY');
	$nombre .= ".log";
	return $nombre;
  }

  //-----------------------MOVIMIENTOS----------------------//
  public static function generarMov($mensaje)
  {
    if(!empty($mensaje) && $mensaje != NULL) {
        $nombreMov = self::devuelveNombreMovActual();
        $mov = fopen("$nombreMov",'a');
        fwrite($mov,"[Fecha: ".date("d-M-Y")."] [Hora: ".date('H:m:s')."] [Movimiento]: $mensaje \r\n"); //dar un salto en linea para mostrarlo en el HTML
        fclose($mov);    
    } else {
        echo "<script>alert('Mensaje del log Vacio, REVISAR!');</script>"; //sirve para el testing...
    }
  }

  //muestra el Log de Errores en una tabla separando linea a linea ($cantidad = cantidad de lineas a mostrar)
  public static function mostrarMov($cantidad)
	{
	$movimientos = file_get_contents(self::devuelveNombreMovActual());
	$array = explode("\n", $movimientos);
	$i = count($array)-2; // - 2 ya que el ultimo elemento siempre sera un salto de linea 

	if($cantidad > count($array))
	{
	$cantidad = count($array)-1;
	}

	echo "<table border='1' align='center' width='1000px'>";
	while($i > (count($array)-$cantidad-2)) //le resto - 2 ya que son las lineas perdidas
	{
	echo  "<tr><td>";
	echo  $array[$i];
	echo  "</td></tr>";        
	$i--;
	}
	echo "</table>";   
  }

  protected static function devuelveNombreMovActual()
  {
	$objeto = new Log();
	$nombre = $objeto->getPathMovs(); 
	$nombre .= "Mov";
	$nombre .= date('dmY');
	$nombre .= ".log";
	return $nombre;
  }

  //funcion de ejemplo, a remover proximamente
  public function ejemplo()
  {
     if(1 == 0) {
	   Log::generarLog("1  =  0 (quien lo diria?)");       
     } else {
	   Log::generarLog(" 1 es desigual a 0");
     }
  }  
}
