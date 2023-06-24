<?php
require '../vendor/autoload.php';
$cox= new \App\connect();
$res=$cox->con->prepare("SHOW TABLES");
$res->execute();
$tables=$res->fetchAll(\PDO::FETCH_COLUMN);
//print_r($tables);

// Obtener la longitud del array
$length = count($tables);

echo "<br>";
// Recorrer el array e imprimir los valores
for ($i = 0; $i < $length; $i++) {
    echo $tables[$i] . "<br>";
    $tableName = $tables[$i];
    
    // Obtener la información de la estructura de la tabla
    $sql = "DESCRIBE $tableName";
    $stmt = $cox->con->prepare($sql);
    $stmt->execute();
    
    // Obtener las columnas de la tabla en un array
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Imprimir las columnas
    foreach ($columns as $column) {
        echo $column . "<br>";
    }

    /* $coxis= new \App\connect();
    $res=$coxis->con->prepare("SELECT * FROM chapters");
    $res->execute();
    $res=$res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
    echo "<br>"; */
    echo "<br>";
}

/* 
// Consulta para obtener las tablas
$sql = "SHOW TABLES";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Obtener los nombres de las tablas en un array
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Imprimir el array con los nombres de las tablas
print_r($tables); */
?>