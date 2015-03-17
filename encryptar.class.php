<?php

class Contenido
{        
	  protected $id;
    protected $texto;
    
    public function __construct(){

    }

    public function getContenido(){
    	return $this->contenido;
    }

    public function setContenido($contenido){    	
    	$this->contenido = $contenido;
    }
   
   	public function encriptar($data, $key){
       $key = "key";       
       $opensslentrypt = openssl_encrypt($data, "aes-256-ofb", $key);
       var_dump($opensslentrypt);die;
       for($i=0; $i< strlen($key); $i++){
            echo $key[$i];
       }

       die;
       return crypt($pass);
   	}

    public function comprimir($data){

    }
}

$cont = new Contenido();
$encriptado = $cont->encriptar("este es mi pass", "keypass");
var_dump($encriptado);
echo "---principio---";
die;

$time = date("G:i:s");
$entry = "Información guardada a las $time.\n";
$file = "/var/www/html/clarin/test.cron.txt";
$open = fopen($file,"a");
if($open){
    fwrite($open,$entry);
    fclose($open);
}else{
	die("error");
}