<?php

require_once 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'example@example.com';
$mail->Password   = '**********';
$mail->SMTPSecure = 'tls';
$mail->Port = 25;

$mail->setFrom('example@example.com', 'Mailer');
$mail->addAddress('example@example.com', 'nombre apellido');
$mail->addAddress('example@example.com.ar', 'nombre apellido');
$mail->addAddress('example@example.com.ar');

$imagen  = 'C:\xampp\htdocs\saraza\adjunto\cruz.png';
$mail->AddEmbeddedImage($imagen, 'logo');

$imagen2 = 'C:\xampp\htdocs\saraza\adjunto\hipno.png';
$mail->AddEmbeddedImage($imagen2, 'hipno');

$imagen3 = 'C:\xampp\htdocs\saraza\adjunto\hipno2.gif';
$mail->AddEmbeddedImage($imagen3, 'hipno2');

$imagen4 = 'C:\xampp\htdocs\saraza\adjunto\avion.gif';
$mail->AddEmbeddedImage($imagen4, 'avion');

$mail->isHTML(true);
$mail->Subject = 'Enviando';

$mail->Body = "<b>Imagen: </b> <h3 align='center'>Titulo: </h3>
    <img alt='(no puede mostrar la imagen)' src='cid:avion' height='430' width='700' style='width:700px;height:430px;' />
    <table border='1' style='border:1px solid black;'>    
    <tr>
        <td><img alt='(no puede mostrar la imagen)' src='cid:logo'></td>   
        <td><img alt='(no puede mostrar la imagen)' src='cid:hipno'></td>
        <td><img alt='(no puede mostrar la imagen)' src='cid:hipno2'></td>
    </tr>
    </table>";

$mail->AltBody = 'Body alternativo';
if (!$mail->send()) {
    echo 'Error al enviar mensaje';
    echo 'PHPMailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mensaje Enviado';
}
