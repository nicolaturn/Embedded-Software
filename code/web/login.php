<?php
if (isset($_POST["submit"])) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "skipass";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $user = $_POST['user'];
  $sql = "SELECT * FROM utenti Where username='" . $user . "'";
  //echo $sql;
  $result = $conn->query($sql);
  //var_dump();
  if ($result->num_rows > 0) {
    //echo $sql;
    while ($row = $result->fetch_assoc()) {
      $pw = $_POST['pass'];
      //echo $pw;
      if ($pw == $row['password']) {
        //echo "rr";
        header("Location: /dashboard/embedded/amm.php");
      } else {
        $error = "Wrong username or password";
      }
    }
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Amministrazione impianti</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
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
  <link href="signin.css" rel="text/css">
</head>

<body class="text-center">
  <main class="form-signin w-25 m-auto" length='100px'>
    <form method="POST" action="">
      <img class="mb-4" src="mg.jpg" alt="" width="300" height="300">
      <h1 class="h3 mb-3 fw-normal">Amministrazione impianti</h1>
      <div class="form-floating">
        <input type="text" class="form-control" id="user" name="user" placeholder="Username" required>
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <?php if (isset($error)) {
        echo "<p style=\"color: #F00;\">" . $error . "</p>";
      }
      ?>
      <input type="submit" name="submit" class="w-100 btn btn-lg btn-primary" value="Accedi" />
    </form>
  </main>
</body>

</html>
<script>
  function validation() {
    var id = document.f1.user.value;
    var ps = document.f1.pass.value;
    if (id.length == "" && ps.length == "") {
      alert("User Name and Password fields are empty");
      return false;
    } else {
      if (id.length == "") {
        alert("User Name is empty");
        return false;
      }
      if (ps.length == "") {
        alert("Password field is empty");
        return false;
      }
    }
  }
</script>