<?php
class PDOConfig extends PDO
{
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $debug;

    public function __construct() {
        $this->engine   = 'mysql';
        $this->host     = 'localhost';
        $this->database = 'db';
        $this->user     = 'root';
        $this->pass     = '';
        $this->debug    = false;        
        $dns = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host;
        return parent::__construct($dns, $this->user, $this->pass);        
    }

    public function query($sql) {
        if ($this->debug) {
            echo "Consulta a ejecutar: /** " . $sql . ' **/ <br />';
        }
        $resultado = parent::query($sql);

        if (!$resultado) {
            if ($this->debug) {
                print_r($this->errorInfo());
            }
            return false;
        }else
            return $resultado;
    }

    public function setDebug($debug) {
        $this->debug = $debug;
    }

    public function getDebug() {
        return $this->debug;
    }
