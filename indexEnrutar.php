<?php
//Libreria bramus
//Documentacion: https://github.com/bramus/router
//se usa para crear endpoints y otros
//RECORDAR cambiar la ruta de .htaccess
    require './vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    // Bad
    $router->get('/hello', function() {
        echo 'GET';
    });

    $router->post('/hello', function() {
        echo 'POST';
    });

    //con esto se trae la data que se envia mediante POST al endpoint datos
    $router->post('/datos', function() {
        $_DATA=file_get_contents('php://input',true);
        $d=$_DATA ?? "Es nulo";
        var_dump($d);
    });
    
    $router->post('/hello', function() {
        new \App\cliente();
    });

    $router->delete('/hello', function() {
        echo 'DELETE';
    });

    //de esta forma se tienen todos
    $router->all('/hello', function() {
        echo 'DELETE';
    });

    $router->run();
?>