<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PERSONEL TAKİP SİSTEMİ</title>

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
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


    $calisanlar = $conn->prepare("SELECT * FROM permission");
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
                <h4>İzin Bilgileri</h4>
                <div class="col-12 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>İzin ID</th>
                                <th>TCKN</th>
                                <th>İzin Türü</th>
                                <th>İzin Başlangıç Tarihiı</th>
                                <th>İzin Bitiş Tarihi</th>
                            </tr>
                        </thead>
                        <?php

                        foreach ($calisanlar as $calisan) {
                            echo "<tr> <td>"
                                . $calisan["PermID"]
                                . "</td>  <td>"
                                . $calisan["TCKN"]
                                . "</td>  <td>" .
                                $calisan["PermType"]
                                . "</td>  <td>"
                                . $calisan["PermStartDate"]
                                . "</td>  <td>"
                                . $calisan["PermEndDate"]

                                . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>

            </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 my-3">
                    <h4>İzin Oluştur</h4>
                    <form id="yeniIzin" action="izinEkle.php" method="POST">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <!-- <div class="form-group mt-3">
                                    <label for="PermID">İzin ID</label>
                                    <input type="number" class="form-control" id="PermID" name="PermID">
                                </div> -->
                                <div class="form-group mt-3">
                                    <label for="TCKN">TCKN</label>
                                    <!-- <input type="text" class="form-control" id="TCKN" name="TCKN"> -->
                                    <select class="form-control" id="TCKN" name="RolTCKNeID">
                                        <option selected>Seçiniz</option>
                                        <?php
                                        $roles = $conn->prepare("SELECT TCKN FROM employee");
                                        $roles->execute();
                                        $roleIDs = $roles->fetchAll(PDO::FETCH_COLUMN);
                                        foreach ($roleIDs as $roleID) {
                                            echo "<option value='" . $roleID . "'>" . $roleID . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="PermType">İzin Türü</label>
                                    <input class="form-control" type="text" id="PermType" name="PermType">
                                </div>


                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="PermStartDate">İzin Başlangıç Tarihi</label>
                                    <input class="form-control" type="text" id="PermStartDate" name="PermStartDate" min="<?php echo $date; ?>" max="2024-12-31">

                                </div>
                                <div class="form-group mt-3">
                                    <label for="PermEndDate">İzin Bitiş Tarihi</label>
                                    <input class="form-control" type="text" id="PermEndDate" name="PermEndDate" min="<?php echo $date; ?>" max="2024-12-31">

                                </div>
                            </div>
                            <div class="col-12 col-lg-6 my-3">
                                <br>
                            </div>
                            <div class="col-12 col-lg-6 my-3" style="text-align: right;">
                                <input type="submit" class="btn btn-primary" value="KAYDET">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            var startDate;
            var endDate;

            $("#PermStartDate").datepicker({
                dateFormat: 'y-m-d'
            });

            $("#PermEndDate").datepicker({
                dateFormat: 'y-m-d'
            });

            $('#PermStartDate').change(function() {
                startDate = $(this).datepicker('getDate');
                $("#PermEndDate").datepicker("option", "minDate", startDate);
            });

            $('#PermEndDate').change(function() {
                endDate = $(this).datepicker('getDate');
                $("#PermStartDate").datepicker("option", "maxDate", endDate);
            });
        });
    </script>
</body>

</html>