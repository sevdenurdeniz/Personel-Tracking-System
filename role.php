<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PERSONEL TAKİP SİSTEMİ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php
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


    $calisanlar = $conn->prepare("SELECT *
    FROM employee
    JOIN role ON employee.RoleID = role.RoleID;");
    $result = $calisanlar->execute();
    // var_dump($result);


    ?>
     <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Çalışan Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calisan.php">Çalışanlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="izin.php">İzin Bilgisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="izinTbl.php">İzin Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="servis.php">Servis Bilgisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="servisTbl.php">Servis Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maas.php">Maaş Bilgisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="role.php">Ünvan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="roleTbl.php">Ünvan Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dept.php">Departman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deptTbl.php">Departman Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="empDept.php">Çalışan-Dept</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="giris.php">Giriş Saatleri</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section>
        <div class="container my-5">
            <div class="row">
                <h4>Ünvan</h4>
                <div class="col-12 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>TCKN</th>
                                <th>Ad</th>
                                <th>Soyad </th>
                                <th>Ünvanı </th>
                                <th>Ünvan Tanımı </th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($calisanlar as $calisan) {
                            echo "<tr> <td>"
                                . $calisan["TCKN"]
                                . "</td>  <td>" .
                                $calisan["FirstName"]
                                . "</td>  <td>" .
                                $calisan["LastName"]
                                . "</td>  <td>" .
                                $calisan["RoleName"]
                                . "</td>  <td>"
                                . $calisan["RoleDesc"]
                                . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>

            </div>
    </section>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</body>

</html>