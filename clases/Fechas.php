<?php
class TipoFecha
{
     /* *******************************************
  	 *           ---- Acerca De ---- 			  *	
	   1- Licencia: GPL  
	   2- Autor: Facundo Giardino
	 ******************************************* */

	 //formatea una fecha para un formato de insercion en la base de datos ('Y-m-d') 
	 public static function formatearFechaParaDb($fecha)
	 {
		if($fecha != null && !empty($fecha))
		{
			$date  = new DateTime($fecha); //se crea un objeto DateTime para manipular las fechas
			$fechaFormateada = $date->format('Y-m-d');
			return $fechaFormateada;
		}
		else
		{
			return "";
		}
	 }
	  
	 //formatea una fecha para mostrar en la web en el formato ('d-m-Y')
	 public static function formatearFechaParaFormulario($fecha)
	 {
	    if($fecha != null && !empty($fecha))
		{
		 	$date  = new DateTime($fecha); //se crea un objeto DateTime para manipular las fechas
			$fechaFormateada = $date->format('d-m-Y');
			return $fechaFormateada;
		}
		else
		{
		    return "";
		}
	 }
	    
	 //Suma dos fechas con el formato que sea, devuelve siempre ('d-m-Y')
	 public function sumaFechas($fecha1, $fecha2)
	 {
        if($fecha1 != null && !empty($fecha1) && $fecha2 != null && !empty($fecha2))
		{
			 $fecha1 = self::formatearFechaParaFormulario($fecha1); //Se asegura de trabajar con los formatos ('d-m-Y')
			 $fecha2 = self::formatearFechaParaFormulario($fecha2); //Se asegura de trabajar con los formatos ('d-m-Y')

			 $fechaFinal = strtotime($fecha1) + strtotime($fecha2);
			 return date('Y-m-d', $fechaFinal);
		}
		else
		{
		 	 return "";
		}
	 }
	 
	 //Suma una cantidad de dias especifico a una determinada fecha $fecha = fecha en cualquier formato. $dias = numero de dias a sumar en formato ENTERO
	 public function sumaDiasAFecha($fecha, $dias)
	 {
	   if($fecha != NULL && !empty($fecha) && $dias != NULL && !empty($dias) && is_numeric($dias))
	   {
			 $fecha = self::formatearFechaParaFormulario($fecha);
			 $nuevafecha = strtotime( "+".$dias." day", strtotime ($fecha));
			 $nuevafecha = date ('Y-m-j', $nuevafecha);
			 return $nuevafecha;
	   }
       else
	   {
			 return "";
	   }	 
	 } 
	 
	 
	 //Calcula la cantidad de dias entre 2 fechas
     public function diasEntreDosFechas($fecha1, $fecha2) 
	 { 
       if($fecha1 != NULL && !empty($fecha1) && $fecha2 != NULL && !empty($fecha2))
	   {
	  	 return floor(abs(strtotime($fecha1) - strtotime($fecha2))/86400); //dividido en 86400 (cant de segundos por dia) para que de la cantidad de dias (funciona?)
	   }
   	   else
	   {
	    	return "";
	   }
	 } 		
	 
}

 /* *******************************************
 *											  *	
 *             EJEMPLOS DE USO				  *	
 *											  *
 ******************************************* */
 
 $objeto = new TipoFecha(); 
 $objeto->sumaFechas("2011-01-01", "2012-01-01");
 echo "<br/>";
 $fecha = "2011-03-03";
 $fecha2 = "03-03-2011";
 echo $objeto->sumaDiasAFecha($fecha2,9000);
 echo "<br />";
 echo "<br />";
 echo  $objeto->diasEntreDosFechas("2012-09-09", "1999-09-09");

 //$fecha1 = new DateTime('Y-m-d', "2011-01-01");
 //$fecha2 = new DateTime('Y-m-d', "2011-01-02");
 //$objeto->sumaFechas($fecha1, $fecha2);
 // $objeto->sumaDiasAFecha("2011-09-10", "40");

			
