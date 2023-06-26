<?php
namespace App;
class connect{
    public $con;
    //  el constra slash "\" es para decirle que son clases del programador mas no clases del PHP nativo
    public function __construct(){
        //parent::__construct();
        try{
            //con lo de PDO se puede hacer aparte lo del usuario o tambien lo del password en uno solo (aqui todo) otra forma (otro,user,password)
            //":host=".$this->__get('host').";
            // SE USA AHORA ":host=".$_ENV['HOST']."; PARA VARIABLE DEL ENTORNO
            //CON ESTO YA SE PUEDE HACER PUBLIC EL $con debido a que ya las guarda el archivo .env
            $this->con=new \PDO($_ENV['DSN'].
            ":host=".$_ENV['HOST'].";
            dbname=".$_ENV['DBNAME'].";
            user=".$_ENV['USERNAME'].";
            password=".$_ENV['PASSWORD'].";
            port=".$_ENV['PORT']);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //print_r("OK");
        }catch(\PDOException $e){
            print_r($e->getMessage());
        }
        //echo "Hola Mundo";
    }
}
?>