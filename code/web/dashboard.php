<?php
if (!isset($_POST['dataselez'])) $_POST['dataselez'] = date("Y-m-d");
// if (!isset($_GET["id"])) 
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Dashboard Template · Bootstrap v5.2</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Ski Center Latemar</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="/dashboard/embedded/index.php">Home</a>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-4 col-lg-2 d-md-block bg-light sidebar collapse" s>
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <!-- LOGO -->
            <img src="./mg.jpg" class="rounded float-start" alt="mountains" width="200px">
            <!-- stats-->

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "skipass";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $km = 0;
            $impdiv = 0;
            $imptot = 0;
            $dislivtot = 0;
            $sql = " select sum(km) as somma from performance inner join impianti on performance.idimp=impianti.idimp  where tessera='" . $_GET["id"] . "' and data=\"" . $_POST['dataselez'] . "\" order by ora  ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                $km = $row["somma"];
              }
            } else {
              echo "Non ci sono eventi per il giorno selezionato.";
            }
            $sql = " select count(distinct nome) as imp from performance inner join impianti on performance.idimp=impianti.idimp  where tessera='" . $_GET["id"] . "' and data=\"" . $_POST['dataselez'] . "\" order by ora  ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                $impdiv = $row["imp"];
              }
            } else {
              echo "Non ci sono eventi per il giorno selezionato";
            }
            $sql = " select count( nome) as imp from performance inner join impianti on performance.idimp=impianti.idimp  where tessera='" . $_GET["id"] . "' and data=\"" . $_POST['dataselez'] . "\" order by ora  ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                $imptot = $row["imp"];
              }
            } else {
              echo "Non ci sono eventi per il giorno selezionato";
            }
            $sql = " select  sum(dislivello) as dis from performance inner join impianti on performance.idimp=impianti.idimp  where tessera='" . $_GET["id"] . "' and data=\"" . $_POST['dataselez'] . "\" order by ora  ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                $dislivtot = $row["dis"];
              }
            } else {
              echo "Non ci sono eventi per il giorno selezionato";
            }
            $conn->close();
            ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home" class="align-text-bottom"></span>
                <?php echo $km; ?> km percorsi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home" class="align-text-bottom"></span>
                <?php echo $imptot; ?> impianti totali
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home" class="align-text-bottom"></span>
                <?php echo $impdiv; ?> impianti diversi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home" class="align-text-bottom"></span>
                <?php echo $dislivtot; ?> dislivello totale
              </a>
            </li>
            <!-- IMMAGINE SCI -->
            <img src="./mg.jpg" class="rounded float-start" alt="mountains" width="200px">

          </ul>
        </div>
      </nav>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">La tua performance</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
            <div class="form-group">
              <form method="post" id="data_form" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo ($_GET["id"]) ?>">
                <select class="form-select" aria-label="Default select example" name="dataselez" onchange="document.forms['data_form'].submit()">
                  <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "skipass";
                  // Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
                  $sql = "SELECT distinct data FROM performance";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                      //echo "<br>d: " . $row["data"]. "<br>";
                      $selected = "";
                      if ($row["data"] == $_POST['dataselez']) $selected = "selected='selected'";
                      echo "<option value=\"" . $row["data"] . "\" {$selected}>" . $row["data"] . "</option>";
                    }
                  } else {
                    echo "Non ci sono eventi per il giorno selezionato";
                  }
                  $conn->close();
                  ?>
                  <!--            <option value="<?php echo date("Y-m-d") ?>" selected>
                  <?php echo date("Y-m-d") ?>
                </option>
              -->
                </select>
              </form>
              <!--       
     <a href="#" class="btn btn-secondary active" role="button" aria-pressed="true">Aggiorna</a>
   -->
            </div>
          </div>
        </div>
        <?php
        //echo $_POST['dataselez'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "skipass";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $dataPoints = array();
        $impianti = array();
        $sql = "select * from performance inner join impianti on performance.idimp=impianti.idimp  where tessera='" . $_GET["id"] . "' and data=\"" . $_POST['dataselez'] . "\" order by ora ;";
        //echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $arr = array($row["ora"], $row["nome"]);
            array_push($impianti, $arr);
            //array_push($impianti, $row["ora"], $row["nome"]);
            $arr = array("label" => $row["ora"], "y" => $row["base"]);
            array_push($dataPoints, $arr);
            $arr = array("label" => $row["ora"], "y" => ($row["cima"]));
            array_push($dataPoints, $arr);
          }
        } else {
          echo "Non ci sono eventi per il giorno selezionato";
        }
        $conn->close();
        ?>
        <script>
          window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
              animationEnabled: true,
              //theme: "light2",

              axisX: {
                title: "Timing",
                interval: 100000,
                crosshair: {
                  enabled: true,
                  snapToDataPoint: true
                }
              },
              axisY: {
                title: "Altitudine [metri]",
                includeZero: true,
                crosshair: {
                  enabled: true,
                  snapToDataPoint: true
                }
              },
              toolTip: {
                enabled: true
              },
              data: [{
                type: "area",
                yValueFormatString: "#### metri s. l. m.",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
              }]
            });
            chart.render();
          }
        </script>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <h2>Elenco impianti del giorno <?php echo $_POST['dataselez']; ?></h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Ora</th>
                <th scope="col">Impianto</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($impianti as $value) {
                echo "<tr>";
                foreach ($value as $v) {
                  //foreach ($v as )
                  echo "<td>" . $v . "</td>";
                }
                echo "<tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <!--<script src="dashboard.js"></script>-->
</body>

</html>