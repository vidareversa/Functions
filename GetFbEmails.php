<?php
$fotos = array();
//Obtener datos de facebook
echo "<div style='margin:0px auto;'>";
for($i=0; $i<200; $i++){    
    $foto = @file_get_contents("https://graph.facebook.com/".$i."?fields=email");    
    if(!empty($foto)){                    
        $email = json_decode($foto)->email;        
        if(!empty($email))
            die("encontro el email: ".$email);

        $objFoto = json_decode($foto);
        if(is_object($objFoto)){
            if(!empty($objFoto->email))
                print_r($foto);          
        }
    }        
}
echo "</div>";
