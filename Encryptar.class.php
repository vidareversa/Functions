<?php

class Contenido
{
    protected $id;
    protected $texto;

    public function __construct()
    { 
        
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    public function encriptar($data, $key = "key")
    {
        $opensslentrypt = openssl_encrypt($data, "aes-256-ofb", $key);
        return $opensslentrypt;
    }

    public function comprimir($data)
    { 

    }
}

$cont = new Contenido();
$encriptado = $cont->encriptar("MiPass", "keypass");
echo "<pre>";
var_dump($encriptado);
echo "</pre>";
/*
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
*/
