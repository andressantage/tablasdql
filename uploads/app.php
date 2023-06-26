<?php
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    //el env es para las variables del sistema
    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
    //el archivo .env deve estar al mismo archivo que donde se pone la variable: $dotenv
    $router->get("/camper", function() {
        //echo $_ENV["HOST"];        
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM areas");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put('/camper', function() {
        $_DATA=json_decode(file_get_contents("php://input"),true);
        $cox= new \App\connect();
        $stmt=$cox->con->prepare("UPDATE areas SET nombre = :NOMBRE WHERE id=:CEDULA");
        $stmt->bindValue("NOMBRE",$_DATA["nom"]);
        $stmt->bindValue("CEDULA",$_DATA["id"]);
        $stmt->execute();
        $stmt=$stmt->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($stmt);
    });

    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM areas WHERE id = :ID"); 
        $res->bindValue("ID", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    
    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true); 
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO areas (edad, nombre) VALUES (:EDAD, :NOMBRE)");
        $res->bindValue("EDAD", $_DATA["edad"]);
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->execute();
        $resi=$res->rowCount(); 
        echo $resi;
    });

    $router->run();
?>