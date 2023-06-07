<?php

if ($_POST) {
    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Hataları görüntüle
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=employee_tracking_system", $username, $password);
        // PDO hata modunu etkinleştir
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $TCKN = $_POST['TCKN'];
    $DeptID = $_POST['DeptID'];
    $DeptStartDate = $_POST['DeptStartDate'];
    $DeptDepartureDate = $_POST['DeptDepartureDate'];

    if (empty($DeptDepartureDate)) {
        $DeptDepartureDate = null;
    }

    try {
        $empdept = $conn->prepare("INSERT INTO empdept (TCKN, DeptID, DeptStartDate, DeptDepartureDate) VALUES (?, ?, ?, ?)");
        $empdept->execute([$TCKN, $DeptID, $DeptStartDate, $DeptDepartureDate]);

        header("location: empDept.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>