<?php
// Configuración de la conexión a la base de datos
/* $servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_la_base_de_datos"; */
require '../vendor/autoload.php';
$cox= new \App\connect();
$res=$cox->con->prepare("SHOW TABLES");

try {
    // Crear una nueva instancia de PDO
    require "../vendor/autoload.php";

    //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Establecer el modo de error de PDO a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener una lista de todas las tablas de la base de datos
    $tables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    // Nombre del archivo SQL
    $filename = "backup.sql";
    
    // Abrir el archivo en modo escritura
    $file = fopen($filename, 'w');
    
    // Iterar sobre las tablas y generar consultas SELECT para obtener los datos
    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table";
        $stmt = $conn->query($sql);
        
        // Obtener los datos y escribirlos en el archivo SQL
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $values = implode("', '", $row);
            $query = "INSERT INTO `$table` VALUES ('$values');";
            fwrite($file, $query . "\n");
        }
    }
    
    // Cerrar el archivo
    fclose($file);
    
    echo "Archivo SQL creado con éxito: $filename";
}
catch(PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
