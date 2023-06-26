<?php
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get("/camper", function() {
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM levels");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put('/camper', function() {
        $_DATA=json_decode(file_get_contents("php://input"),true);
        $cox= new \App\connect();
        $res=$cox->con->prepare("UPDATE levels SET name_level = :NOMBRE WHERE id=:CEDULA");
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->bindValue("CEDULA",$_DATA["id"]);
        $res->execute();
        $res=$res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    /* {
        "id": 14,
        "nom": "Facil y dificil" 
    } */

    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM levels WHERE id = :ID"); 
        $res->bindValue("ID", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    
    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true); 
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO levels (name_level,group_level) VALUES (:NOMBRE,:r)");
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->bindValue("r", $_DATA["r"]); 
        $res->execute();
        $resi=$res->rowCount(); 
        echo $resi;
    });
    /* {
        "nom": "Facil",
        "r": "A1"
    } */

    $router->run();

?>