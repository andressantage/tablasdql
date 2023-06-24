<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_la_base_de_datos";

require "../vendor/autoload.php";
//new \App\connect();


$conn= new \App\connect();
//$res=$cox->con->prepare("SELECT * FROM tablass");
//$res->execute();
//$res=$res->fetchAll(\PDO::FETCH_ASSOC);
//echo json_encode($res);


try {
    // Crear una nueva instancia de PDO
    //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn= new \App\connect();
    // Establecer el modo de error de PDO a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener el esquema y los datos de las tablas
    $sql = "SHOW TABLES";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Crear el contenido SQL
    $content = "";
    
    // Recorrer las tablas
    while ($table = $stmt->fetch(PDO::FETCH_NUM)) {
        $tableName = $table[0];
        
        // Obtener la estructura de la tabla
        $structure = $conn->query("SHOW CREATE TABLE $tableName")->fetch(PDO::FETCH_ASSOC);
        $content .= "\n\n" . $structure['Create Table'] . ";\n\n";
        
        // Obtener los datos de la tabla
        $data = $conn->query("SELECT * FROM $tableName")->fetchAll(PDO::FETCH_ASSOC);
        
        // Generar sentencias INSERT INTO
        foreach ($data as $row) {
            $rowValues = array_map(function($value) use ($conn) {
                return $conn->quote($value);
            }, $row);
            
            $content .= "INSERT INTO $tableName VALUES (" . implode(",", $rowValues) . ");\n";
        }
    }
    
    // Nombre del archivo
    $filename = "backup.sql";
    
    // Crear el archivo y escribir el contenido SQL
    file_put_contents($filename, $content);
    
    // Configurar las cabeceras de descarga
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filename));
    
    // Enviar el contenido del archivo al navegador
    readfile($filename);
    
    // Eliminar el archivo
    unlink($filename);
}
catch(PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
