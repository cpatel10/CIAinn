<?php
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=ciainn;port=3306','ishparii','111111');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        $error = 'Unable to connect to the database server.';
        include 'error.html.php';
        exit();
    }
?>
