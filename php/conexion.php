<?php
$host = 'localhost'; //
$dbname = 'BDD_ELECMIR'; // Nombre de la base de datos
$username = 'danitom89'; //
$password = '1234'; //

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
