<?php
    header("Access-Control-Allow-Origin: *");
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    //el env es para las variables del sistema
    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
    //el archivo .env deve estar al mismo archivo que donde se pone la variable: $dotenv
    $router->get("/{tabla}", function($tabla) {
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM ".$tabla);
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        $x=json_encode($res);
        //var_dump($x);
        echo $x;
    });

    /* $router->get("/camper", function() {
        //echo $_ENV["HOST"];        
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM usuarios");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    }); */

    $router->run();
?>