<?php
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get("/camper", function() {
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM personal_ref");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put('/camper', function() {
        $_DATA=json_decode(file_get_contents("php://input"),true);
        $cox= new \App\connect();
        $res=$cox->con->prepare("UPDATE personal_ref SET full_name = :NOMBRE WHERE id=:CEDULA");
        $res->bindValue("NOMBRE",$_DATA["nom"]);
        $res->bindValue("CEDULA",$_DATA["id"]);
        $res->execute();
        $res=$res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    /* {
        "id": 541857,
        "nom": "Andres Santana."
    } */

    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM personal_ref WHERE id = :ID"); 
        $res->bindValue("ID", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    
    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true); 
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO personal_ref (full_name,cel_number,relationship,occupation) VALUES (:NOMBRE,:r,:r1,:r2)");
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->bindValue("r", $_DATA["r"]); 
        $res->bindValue("r1", $_DATA["r1"]); 
        $res->bindValue("r2", $_DATA["r2"]); 
        $res->execute();
        $resi=$res->rowCount(); 
        echo $resi;
    });
    /* {
        "nom": "Andres Santana",
        "r": "3163748711",
        "r1": "Soltero",
        "r2": "Ocupado"
    } */

    $router->run();

?>