<?php
namespace App;
trait system{
    public function data(){
        return (file_get_contents('php://input')=="") ? ["Mensaje"=>null] : json_decode(file_get_contents('php://input',true));
    }
}
?>