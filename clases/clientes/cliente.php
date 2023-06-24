<?php
    namespace App;
    
    class cliente{ 
        use system;
        public function __construct(){
            $_DATA=$this->data();
            print_r($_DATA);
            echo "Desde la clase de ClientesNamespace.php";
        }
    } 
?>