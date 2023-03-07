<?php

$_POST["tessnr"] = $_POST["ncarta"];


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
$sql = "SELECT * FROM ltl ;";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $ltl = $row["id"];
    $_POST["tessnr"] = $ltl;
  }
} else {
}
$conn->close();
// header("Refresh:0");


?>




<?php
//pagina web
$associa = 0;
$dissocia = 0;

if (array_key_exists("associa", $_POST)) {
  associa();
}
if (array_key_exists("dissocia", $_POST)) {
  dissocia();
}
function associa()
{
  $associa = 1;
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
  $sql = "INSERT INTO tessere VALUES ('" . $_POST["tessnr"] . "')";
  //echo $sql;
  if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Tessera associata correttamente');</script>";
  } else {
    echo "<script type='text/javascript'>alert('Errore');</script>";
  }
  $conn->close();
}
function dissocia()
{
  $dissocia = 1;
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
  // sql to delete a record
  $sql = "DELETE FROM tessere WHERE id='" . $_POST["tessnr"] . "'";
  if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Tessera eliminata correttamente');</script>";
  } else {
    echo "<script type='text/javascript'>alert('Errore');</script>";
  }
  $conn->close();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Amministrazione impianti</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">Ski Center Latemar</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link fw-bold py-1 px-0" href="/dashboard/embedded/index.php"> Home </a>
        </nav>
      </div>
    </header>
    <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h2>Gestione tessere</h2>
      </div>
      <div class="col-md-7 col-lg-8">
        <div class="row g-3">
          <!-- Bottone leggi tessera -->
          <form class="needs-validation" method="get" onchange="">
            <button class="w-50 btn btn-primary btn-lg" name="leggi" type="submit"> Leggi tessera </button>
          </form>

          <!-- ricezione numero tessera dalla scheda-->
          <!-- input nr tessera -->

          <form method="post" onchange="">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Numero tessera</label>
              <input type="text" class="form-control" id="tessnr" name="tessnr" placeholder="Numero tessera" value="<?php echo $ltl ?>" disabled>
          </form>
          <!-- poi aggiungere disabled-->
        </div>
        <hr class="my-4">
        <?php
        if (isset($_POST["tessnr"])) {
          //echo $_POST["tessnr"];
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
          $sql = "SELECT * FROM tessere where id='" . $_POST["tessnr"] . "';";
          //echo $sql;
          $result = $conn->query($sql);
          $qualcosa = 0;
          if ($result->num_rows > 0) {
            // output data of each row

            $qualcosa = 1; //c'è qualcosa
          }
          $conn->close();
          //echo $qualcosa;
          if ($qualcosa == 1) {
        ?>
            <!-- Tessera  associata -->
            <h4 class="mb-3 " style="color: green">Tessera associata</h4>
            <form method="post" name="as" onchange="">
              <button class="w-50 btn btn-danger btn-lg" name="dissocia" type="submit"> Dissocia </button>
            </form>
          <?php
          } else {
          ?>
            <!-- Tessera non associata  -->
            <h4 class="mb-3 " style="color: red">Tessera non associata</h4>
            <form method="post" name="as" onchange="">
              <button class="w-50 btn btn-success btn-lg" name="associa" type="submit"> Associa </button>
            </form>

            <hr class="my-4">
        <?php
          }
        }
        ?>
        </form>
      </div>

    </main>
  </div>
</body>

</html>