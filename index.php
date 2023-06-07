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


    $calisanlar = $conn->prepare("SELECT * from employee");
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
        <div class="container-fluid my-5">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>TCKN </th>
                            <th>FirstName </th>
                            <th>Minit </th>
                            <th>LastName </th>
                            <th>Address </th>
                            <th>BirthDate </th>
                            <th>PhoneNumber </th>
                            <th>Salary </th>
                            <th>Gender </th>
                            <th>StartDate </th>
                            <th>DepartureDate </th>
                            <th>NumberOfPermits </th>
                            <th>DeptID </th>
                            <th>RouteID </th>
                            <th>RoleID </th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($calisanlar as $calisan) {
                        echo "<tr>
            <td>" . $calisan["TCKN"]
                            . "</td>  <td>"
                            . $calisan["FirstName"]
                            . "</td>  <td>" .
                            $calisan["Minit"]
                            . "</td>  <td>"
                            . $calisan["LastName"]
                            . "</td>  <td>"
                            . $calisan["Address"]
                            . "</td>  <td>"
                            . $calisan["BirthDate"]
                            . "</td>  <td>"
                            . $calisan["PhoneNumber"]
                            . "</td>  <td>"
                            . $calisan["Salary"]
                            . "</td>  <td>"
                            . $calisan["Gender"]
                            . "</td>  <td>"
                            . $calisan["StartDate"]
                            . "</td>  <td>"
                            . $calisan["DepartureDate"]
                            . "</td>  <td>"
                            . $calisan["NumberOfPermits"]
                            . "</td>  <td>"
                            . $calisan["DeptID"]
                            . "</td>  <td>"
                            . $calisan["RouteID"]
                            . "</td>  <td>"
                            . $calisan["RoleID"]
                            . "</td>";

                        echo "<td><a href='sil.php?TCKN=" . $calisan["TCKN"] . "'>Sil</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
    </section>

    </div>

    <hr />


    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 my-3">
                    <h4>YENİ KAYIT OLUŞTUR</h4>
                    <form id="yeniPersonel" action="kaydet.php" method="POST">
                        <div class="row">
                            <div class="col-12 col-lg-6">

                                <div class="form-group mt-3">
                                    <label for="TCKN">TCKN*</label>
                                    <input type="number" maxlength="11" minlength="11" class="form-control" id="TCKN" name="TCKN" placeholder="TCKN">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">Adı*</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="FirstName">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">İkinci Adı</label>
                                    <input type="text" class="form-control" id="Minit" name="Minit" placeholder="Minit">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">Soyadı *</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="LastName">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="Address">Adres</label>
                                    <textarea class="form-control" id="Address" name="Address" rows="4"></textarea>
                                </div>
                                <?php
                                $date = date('Y-m-d'); // Bugünün tarihini alır (YYYY-AA-GG formatında)
                                ?>
                                <div class="form-group mt-3">
                                    <label for="BirthDate">Doğum Tarihi:</label>
                                    <!-- <input class="form-control" type="date" id="BirthDate" name="BirthDate" value="2018-07-22" min="2018-01-01" max="2018-12-31"> -->
                                    <input class="form-control" type="date" id="BirthDate" name="BirthDate" value="<?php echo $date; ?>" min="1965-01-01" max="2010-12-31">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="PhoneNumber">Telefon Numarası</label>
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="PhoneNumber">
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="Salary">Maaş</label>
                                    <input type="text" class="form-control" id="Salary" name="Salary" placeholder="Salary">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="Gender">Cinsiyet</label>
                                    <select class="form-control" id="Gender" name="Gender">
                                        <option>Kadın</option>
                                        <option>Erkek</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="StartDate">Başlangıç Tarihi:</label>
                                    <input class="form-control" type="text" id="StartDate" name="StartDate" value="<?php echo $date; ?>" min="1965-01-01" max="2023-12-31">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="DepartureDate">Ayrılış Tarihi:</label>
                                    <input class="form-control" type="text" id="DepartureDate" name="DepartureDate" value="<?php echo $date; ?>" min="1965-01-01" max="2023-12-31">

                                </div>
                                <div class="form-group mt-3">
                                    <label for="NumberOfPermits">İzin Hakkı</label>
                                    <input type="text" class="form-control" id="NumberOfPermits" name="NumberOfPermits" placeholder="NumberOfPermits">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="DeptID">Departman Id</label>
                                    <!-- <input type="text" class="form-control" id="DeptID" name="DeptID" placeholder="DeptID"> -->
                                    <select class="form-control" id="DeptID" name="DeptID">
                                        <?php
                                        $departments = $conn->prepare("SELECT DeptID FROM department");
                                        $departments->execute();
                                        $deptIDs = $departments->fetchAll(PDO::FETCH_COLUMN);
                                        foreach ($deptIDs as $deptID) {
                                            echo "<option value='" . $deptID . "'>" . $deptID . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="RouteID">Servis ID</label>
                                    <!-- <input type="text" class="form-control" id="RouteID" name="RouteID" placeholder="RouteID"> -->
                                    <select class="form-control" id="RouteID" name="RouteID">
                                        <?php
                                        $services = $conn->prepare("SELECT RouteID FROM service");
                                        $services->execute();
                                        $routeIDs = $services->fetchAll(PDO::FETCH_COLUMN);
                                        foreach ($routeIDs as $routeID) {
                                            echo "<option value='" . $routeID . "'>" . $routeID . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="RoleID">Ünvan ID</label>
                                    <!-- <input type="text" class="form-control" id="RoleID" name="RoleID" placeholder="RoleID"> -->
                                    <select class="form-control" id="RoleID" name="RoleID">
                                        <?php
                                        $roles = $conn->prepare("SELECT RoleID FROM role");
                                        $roles->execute();
                                        $roleIDs = $roles->fetchAll(PDO::FETCH_COLUMN);
                                        foreach ($roleIDs as $roleID) {
                                            echo "<option value='" . $roleID . "'>" . $roleID . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <br>
                            </div>
                            <div class="col-12 col-lg-6 mt" style="text-align:right;">
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
            var startDate2;
            var endDate2;

            $("#StartDate").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $("#DepartureDate").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $('#StartDate').change(function() {
                startDate2 = $(this).datepicker('getDate');
                $("#DepartureDate").datepicker("option", "minDate", startDate2);
            });

            $('#DepartureDate').change(function() {
                endDate2 = $(this).datepicker('getDate');
                $("#StartDate").datepicker("option", "maxDate", endDate2);
            });
            $('#yeniPersonel').submit(function(event) {
                // DepartureDate değerini kontrol edin ve boşsa null olarak ayarlayın
                var departureDateValue = $("#DepartureDate").val();
                if (departureDateValue === '') {
                    $("#DepartureDate").val(null);
                }
            });

        });
    </script>
    <script>
        // $('#yeniPersonel').submit(function(e) {
        //   e.preventDefault();
        //    let formData = $(this).serializeArray();
        //   console.log(formData);
        //   }); 
    </script>
</body>

</html>