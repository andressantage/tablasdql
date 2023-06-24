<?php
namespace App;
use PDO;
class connect extends credentials{
    public $con;
    //  el constra slash "\" es para decirle que son clases del programador mas no clases del PHP nativo
    public function __construct(private $dsn="mysql", private $port=3306){
        //parent::__construct();
        try{
            //con lo de PDO se puede hacer aparte lo del usuario o tambien lo del password en uno solo (aqui todo) otra forma (otro,user,password)
            $this->con=new \PDO($this->dsn.
            ":host=".$this->__get('host').";
            dbname=".$this->__get('dbname').";
            user=".$this->username.";
            password=".$this->__get('password').";
            port=".$this->port);
            //print_r("OK");
        }catch(\PDOException $e){
            print_r($e->getMessage());
        }
        //echo "Hola Mundo";
    }
}
?>