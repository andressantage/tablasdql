<?php
    require '../vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get("/camper", function() {
        $cox= new \App\connect();
        $res=$cox->con->prepare("SELECT * FROM cities");
        $res->execute();
        $res=$res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put('/camper', function() {
        $_DATA=json_decode(file_get_contents("php://input"),true);
        $cox= new \App\connect();
        $stmt=$cox->con->prepare("UPDATE cities SET name_city = :NOMBRE WHERE id=:CEDULA");
        $stmt->bindValue("NOMBRE",$_DATA["nom"]);
        $stmt->bindValue("CEDULA",$_DATA["id"]);
        $stmt->execute();
        $stmt=$stmt->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($stmt);
    });
/* {
    "id":,
"nom": "Florida",
} */
    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM cities WHERE id = :ID"); 
        $res->bindValue("ID", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();//es para obtener el número de filas afectadas por la actualización
        echo json_encode($res);
    });
    
    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true); 
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO cities (name_city) VALUES (:NOMBRE)");
        $res->bindValue("NOMBRE", $_DATA["nom"]); 
        $res->execute();
        $resi=$res->rowCount(); 
        echo $resi;
    });
/* {
    "nom": "Florida",
    "r": 123
} */

    $router->run();

?>