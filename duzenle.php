<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PERSONEL TAKİP SİSTEMİ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <?php

    if ($_POST) {
        $id = $_GET["id"];
        $servername = "localhost";
        $username = "root";
        $password = "root";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=employee_tracking_system", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare the update statement
            $update_query = "UPDATE employee SET TCKN=?, FirstName=?, Minit=?, LastName=?, Address=?, BirthDate=?, PhoneNumber=?, Salary=?, Gender=?, StartDate=?, DepartureDate=?, NumberOfPermits=?, DeptID=?, RouteID=?, RoleID=? WHERE TCKN=?";
            $update = $conn->prepare($update_query);

            // execute the update statement
            $update->execute(array($_POST["TCKN"], $_POST["FirstName"], $_POST["Minit"], $_POST["LastName"], $_POST["Address"], $_POST["BirthDate"], $_POST["PhoneNumber"], $_POST["Salary"], $_POST["Gender"], $_POST["StartDate"], $_POST["DepartureDate"], $_POST["NumberOfPermits"], $_POST["DeptID"], $_POST["RouteID"], $_POST["RoleID"], $id));

            // redirect to the index page
            header("location:index.php");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    if ($_GET) {
        $id = $_GET["TCKN"];
        $servername = "localhost";
        $username = "root";
        $password = "root";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=employee_tracking_system", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // fetch the updated employee data
            $employee = $conn->prepare("SELECT * FROM employee WHERE TCKN=?");
            $employee->execute(array($id));
            $calisanlar = $employee->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 my-3">
                    <h4>Düzenle</h4>
                    <form id="duzenlePersonel" action="duzenle.php" method="POST">
                        <div class="row">
                            <div class="col-12 col-lg-6">

                                <div class="form-group mt-3">
                                    <label for="TCKN">TCKN</label>
                                    <input type="text" class="form-control" id="TCKN2" name="TCKN" placeholder="TCKN">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">FirstName</label>
                                    <input type="text" class="form-control" id="FirstName2" name="FirstName" placeholder="FirstName">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">Minit</label>
                                    <input type="text" class="form-control" id="Minit2" name="Minit" placeholder="Minit">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="FirstName">LastName</label>
                                    <input type="text" class="form-control" id="LastName2" name="LastName" placeholder="LastName">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="Address">Address</label>
                                    <textarea class="form-control" id="Address2" name="Address" rows="3"></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="BirthDate">BirthDate:</label>
                                    <input class="form-control" type="date" id="BirthDate2" name="BirthDate" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="PhoneNumber">PhoneNumber</label>
                                    <input type="text" class="form-control" id="PhoneNumber2" name="PhoneNumber" placeholder="PhoneNumber">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="Salary">Salary</label>
                                    <input type="text" class="form-control" id="Salary2" name="Salary" placeholder="Salary">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="Gender2">Gender</label>
                                    <select class="form-control" id="Gender2" name="Gender">
                                        <option>Kadın</option>
                                        <option>Erkek</option>
                                        <option>Belirtmek İstemiyorum</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="StartDate">StartDate:</label>
                                    <input class="form-control" type="date" id="StartDate2" name="StartDate" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="DepartureDate">DepartureDate:</label>
                                    <input class="form-control" type="date" id="DepartureDate2" name="DepartureDate" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="NumberOfPermits">NumberOfPermits</label>
                                    <input type="text" class="form-control" id="NumberOfPermits2" name="NumberOfPermits" placeholder="NumberOfPermits">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="DeptID">DeptID</label>
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
                                    <label for="RouteID">RouteID</label>
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
                                    <label for="RoleID">RoleID</label>
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
                            <div class="col-12 ">
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
    <script>
        // $('#duzenlePersonel').submit(function(e) {
        //     e.preventDefault();
        //    let formData = $(this).serializeArray();
        //  console.log(formData);
        // });
    </script>
</body>

</html>