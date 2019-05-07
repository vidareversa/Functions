
<?php

class Scrap
{
    public $emailsRecords;
    public $urlRecords;
    public $ajaxRecords;
    public $imgsPhpRecords;
    public $sqliRecords;
    //busca imagenes cargadas con php
    protected function parsearImgByPhp($source)
    {
        return strpos($source, ".php");
    }
    protected function parsearAjaxRequest($source)
    {
        return substr_count($source, "ajax");
    }
    protected function getEmails($source)
    {
        $regex = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i';
        preg_match_all($regex, $source, $emails);
        return $emails;
    }
    public function getWebSource($url)
    {
        $source = @file_get_contents($url);
        if (!empty($source)) {
            $this->emailsRecords = $this->parsearEmail($source);
            $this->urlRecords   = $this->parsearUrls($source);
            $this->ajaxRecords  = $this->parsearAjaxRequest($source);
        }
    }

    protected function getLinks($url)
    {
        $regex = '<a\s[^>*href=(\"??)()[^\" >]*?)\\1[^>]*>(.*)<\/a>';
        preg_match_all("/$regex/siU", $content, $matches);
    }

    public function fuerzaBruta()
    {
        /*************************************/
        $charSet = utf8_decode('abcdefghijklmnopqrstuvwxyz');
        $maxLength = strlen($charSet);
        $cantCaracteres = $size = strlen($charSet);
        $base = array();
        $counter = 0;
        $baseSize = 1;

        $libNum = 1;
        $tr = true;


        $combinations = 0;
        for ($i = 1; $i <= $maxLength; $i++) {
            $combinations += pow($size, $i);
        }
        flush();
        while ($baseSize <= $maxLength && $tr) {
            set_time_limit(0);
            for ($i = 0; $i < $cantCaracteres && $tr; $i++) {
                $base[0] = $i;
                $cadena = '';
                for ($j = $baseSize - 1; $j >= 0; $j--)
                    if (!empty($charSet[$base[$j]]))
                        $cadena .= $charSet[$base[$j]];


                $archivo = 'diccionarios/lib' . $libNum . '.txt';
                $file = fopen($archivo, 'a+');
                fwrite($file, $cadena . "\n");
                fclose($file);

                if (strlen($cadena) == 10)
                    $tr = false;
                # die("strlen de cadena es igual a 5");

                echo $cadena . "<br/>";
                #echo "tamaño: ".filesize($archivo)."<br/>";

                clearstatcache();
                if (file_exists($archivo) && filesize($archivo) > (1024 * 1024)) {
                    $libNum++;
                }


                //$destino = "http://www.".$cadena.".com.ar";
                //$source = @file_get_contents($destino);
                /*
                if(!empty($source))
                {
                    $this->emailsRecords = $this->parisearEmail($source);            
                    $this->urlRecords   = $this->parsearUrls($source);            
                    $this->ajaxRecords  = $this->parsearAjaxRequest($source);
                }
                */
                flush();
                ob_flush();
            }
            for ($i = 0; $i < $baseSize; $i++) {
                if ($base[$i] == $size - 1)
                    $counter++;
                else
                    break;
            }
            if ($counter == $baseSize) {
                for ($i = 0; $i <= $baseSize; $i++) {
                    $base[$i] = 0;
                }
                $baseSize = count($base);
            } else {
                $base[$counter]++;
                for ($i = 0; $i < $counter; $i++) {
                    $base[$i] = 0;
                }
            }
            $counter = 0;
        }
    }
}
