
<?php
/*
 Author: Facundo Giardino
*/
/**
 * Clase para testear la performance del proyecto
 *
 * @author facundo
 */
class Performance {
    //put your code here
    public $tiempo;
    public $memoria;
    public $rutaLogPer;   
            
    public function __construct(){
        $this->rutaLogPer = ROOT."/logs/LogPerformance-".date('Ymd').".log";
    }
    
    /*
     * Comienza el contador de tiempo y de memoria
     */
    public function iniPerformance(){
        $this->tiempo = microtime(TRUE);
        $this->memoria = memory_get_usage();
    }
    
    /*
     * Finaliza el contador de tiempo y de memoria y lo inserta en un log (se debe llamar a iniPerformance() con anterioridad)
     */    
    public function finPerformance(){
        $memoria = memory_get_usage() - $this->memoria;
        $tiempo = microtime(TRUE) - $this->tiempo;
        
        $data = "Performance-tiempo:  ".$tiempo."\n ";
        file_put_contents($this->rutaLogPer, $data, FILE_APPEND | LOCK_EX);        
    }
    
    /*
     *  Recupera el contenido del log del dia de la fecha y lo vuelva en el html
     */    
    public function showLog(){
        $logPer = file_get_contents($this->rutaLogPer);
        $logPer = explode("\n", $logPer);
        foreach($logPer as $linea)
            echo $linea."<br/>";
        
    }
        
    public function imprimirTest(){            
        print_r(array($this->tiempo, $this->memoria));
    }
}
