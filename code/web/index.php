<?php
$_POST["numins"] = "n"; //default n

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
  }
} else {
  echo "Non ci sono eventi per il giorno selezionato";
}
$conn->close();
//diventa s se appoggio tessera

if (isset($_POST["tverif"])) {
  $_POST["numins"] = "s";
}


?>
<!doctype html>
<html lang="it" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>SKI CENTER LATEMAR</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <link href="cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column ">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">Ski Center Latemar</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link fw-bold py-1 px-0" href="/dashboard/embedded/login.php"> Amministrazione impianti </a>
        </nav>
      </div>
    </header>
    <main class="px-3">
      <h1>Vedi le tue prestazioni</h1>
      <form method="POST" action="">

        <div class="col-sm w-100">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Inserisci il codice della tessera senza spazi: </span>
            <input type="text" class="form-control" id="basic-url" name="tessnum" id="tessnum" value="<?php echo $ltl ?>" aria-describedby="basic-addon3">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" name="tverif" id="tverif">Verifica</button>
            </div>
          </div>
        </div>

      </form>

      <?php
      if (isset($_POST["tessnum"])) {
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
        $sql = "SELECT * FROM tessere where id='" . $_POST["tessnum"] . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
      ?>
            <p class="lead text-success">Tessera valida</p>
            <p class="lead">
              <a href="/dashboard/embedded/dashboard.php?id=<?php echo ($_POST["tessnum"]) ?>" class="btn btn-lg btn-primary fw-bold border-dark bg-dark">Accedi</a>
            </p>
          <?php
          }
        } else {
          ?>
          <p class="lead text-danger">Tessera non valida</p>
      <?php
        }
        $conn->close();
      }
      ?>
    </main>
    <footer class="mt-auto text-white-50">
    </footer>
  </div>
</body>

</html>