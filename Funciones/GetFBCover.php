<?php

/* 
   Editado: Parece que facebook cambió las politicas de seguridad 
   y ahora pide un token para obtener la data
*/

/**************************************/
$fotos = array();
//Obtener datos de facebook
for($i=0; $i<500; $i++){
    $foto = @file_get_contents("https://graph.facebook.com/".$i."?fields=cover");
    if(!empty($foto)){        
        $objFoto = json_decode($foto);        
        if(is_object($objFoto)){            
            $propiedades = get_object_vars($objFoto);                        
            if(!empty($objFoto->cover))
                if(!empty($objFoto->cover->source))
                    $fotos [] = $objFoto->cover;
        }
    }        
}

echo "<div style='margin:0px auto;'>";
$i = 0;
foreach($fotos as $foto){    
    if(is_object($foto))
        echo "<img src='".$foto->source."' height='100' width='100' align='left' />";            
}
echo "</div>";

/*
//De aca para abajo anda bien!
$graph = file_get_contents("https://graph.facebook.com/facundo.giardino.1?fields=cover");
$obj   = json_decode($graph)->cover;
//print_r($obj);

echo "<img src='".$obj->source."' height='100' width='100' />";
$datos = str_replace("}", "", (str_replace("{", "", $graph)));
$datos = explode(",", $datos);
$arrayFinal = array();
foreach($datos as $dato){
	$oldAndNewValue = explode(":", $dato);	
	$arrayFinal [$oldAndNewValue[0]] = $oldAndNewValue[1];
}


echo "<pre>";
print_r($arrayFinal);
echo "<hr/>";
/**************************************/
