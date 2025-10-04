<?php
$host = "";
$port = "";
$dbname = ""; 
$user = "";
$pass = "";

try {
    $db = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ei saa ühendust midagi valesti: " . $e->getMessage());
}

?>
<!-- 'db.php' faili jaoks pole eraldi kaitset vaja, kuid turvalisuse huvides võib selle koodi convertida näiteks configu või .env faili. -->
