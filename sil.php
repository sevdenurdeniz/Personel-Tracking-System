<?php 


if($_GET){
    

    $id= $_GET["TCKN"];
  //  $gorev = $_POST["calisan"];
    $servername = "localhost";
    $username = "root";
    $password = "root";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=employee_tracking_system", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $calisanlar = $conn->prepare("CALL DeleteEmployee(?)");
    $sonuc = $calisanlar->execute(array($id));
    header("location:index.php");


    

}

?>