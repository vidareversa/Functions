<?php

class Encrypt
{

  public function proxy($url = '', $data = '')
  {

    //$data = //array('DNI' => 'xxxx'); //POST DATA

    $torSocks5Proxy = "socks5://127.0.0.1:9050";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_setopt($ch, CURLOPT_PROXY, $torSocks5Proxy);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_URL, $url);
    $html = curl_exec($ch);
    curl_close($ch);
    var_dump($html);
  }
}

/********* Ejemplo (tiene que estar Tor corriendo, probado en linux) *********/
$crypt = new Encrypt();
$url = "https://check.torproject.org/";
$data = ""; //array('DNI' => 'xxxx');
$crypt->proxy();
