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
    $FirstName = $_POST['FirstName'];
    $Minit = $_POST['Minit'];
    $LastName = $_POST['LastName'];
    $Address = $_POST['Address'];
    $BirthDate = $_POST['BirthDate'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Salary = $_POST['Salary'];
    $Gender = $_POST['Gender'];
    $StartDate = $_POST['StartDate'];
    $DepartureDate = $_POST['DepartureDate'];
    $NumberOfPermits = $_POST['NumberOfPermits'] !== '' ? intval($_POST['NumberOfPermits']) : 0;
    $DeptID = $_POST['DeptID'];
    $RouteID = $_POST['RouteID'];
    $RoleID = $_POST['RoleID'];

    if (empty($DepartureDate)) {
        $DepartureDate = null;
    }

    try {
        $calisanlar = $conn->prepare("INSERT INTO employee (TCKN, FirstName, Minit, LastName, Address, BirthDate, PhoneNumber, Salary, Gender, StartDate, DepartureDate, NumberOfPermits, DeptID, RouteID, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $calisanlar->execute([$TCKN, $FirstName, $Minit, $LastName, $Address, $BirthDate, $PhoneNumber, $Salary, $Gender, $StartDate, $DepartureDate, $NumberOfPermits, $DeptID, $RouteID, $RoleID]);

        header("location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>