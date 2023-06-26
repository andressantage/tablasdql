<?php
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get("/camper", function() {
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM team_educators");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put('/camper', function() {
        $_DATA=json_decode(file_get_contents("php://input"),true);
        $cox= new \App\connect();
        $stmt=$cox->con->prepare("UPDATE team_educators SET name_rol = :NOMBRE WHERE id=:CEDULA");
        $stmt->bindValue("NOMBRE",$_DATA["nom"]);
        $stmt->bindValue("CEDULA",$_DATA["id"]);
        $stmt->execute();
        $stmt=$stmt->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($stmt);
    });
    /* {
        "id": 4,
        "nom": "Estudiante premium 8"
    } */

    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM team_educators WHERE id = :ID"); 
        $res->bindValue("ID", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    
    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true); 
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO team_educators (name_rol) VALUES (:NOMBRE)");
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->execute();
        $resi=$res->rowCount(); 
        echo $resi;
    });
    /* {
        "nom": "Estudiante premium"
    } */

    $router->run();

?>