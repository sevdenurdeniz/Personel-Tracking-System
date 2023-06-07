<?php

if ($_POST) {
    $servername = "localhost";
    $username = "root";
    $password = "root";

    //hatayı görrr
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=employee_tracking_system", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $posts = $_POST;
    $exec = array();
    foreach ($posts as $post) {
        $exec[] = $post;
    }

    $calisanlar = $conn->prepare("INSERT INTO role SET
    RoleID=?,
    RoleName=?,
    RoleDesc=?
    ");
    $ekle = $calisanlar->execute($exec); 
    if ($ekle) {
        header("location:roleTbl.php");
    } else {
        echo "hata";
    }

}
