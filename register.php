<?php
  try {
    $conf = include "conf.php";

    $db = new \PDO ( $conf['dsn'], $conf['user'], $conf['pass'], [
      \PDO::ATTR_PERSISTENT         => true,
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);

    $insertStatement = $db->prepare("insert into leads values(?, ?)");

    if (!empty($_POST["username"]) && !empty($_POST["userphone"])) {
      $insertStatement->execute([$_POST["username"], $_POST["userphone"]]);
    }

  } catch (Exception $e) {
    error_log($e->getMessage());
  }
?>


<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-theme.min.css">
  <title>Esoft competition</title>
  <style>
    body {
        background: url(/assets/img/background-2.png);
        min-height: 800px;
        background-repeat: no-repeat;
    }

    h1 {
      max-width: 450px;
      color: white;
      text-align: right;
      margin-left: auto;
      font-size: 54px;
      margin-top: 35px;
    }

    h2 {
      max-width: 520px;
      margin-left: auto;
      color: #0d385d;
    }

    .second-row {
      margin-top: 160px;
    }

    .third-row {
      margin-top: 80px;
    }

    input {
      border-radius: 50px;
      font-size: 18px;
      padding: 8px 40px;
      border: none;
      margin-right: 15px;
    }

    input[type="submit"] {
      background-color: #48ade0;
      color: white;
    }

  </style>
</head>
<body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <h1>ВЫИГРАЙ КВАДРОКОПТЕР НА DUMP 2017</h1>
        </div>
      </div>

      <div class="row second-row">
        <div class="col-md-6">
          <h2>Оставьте имя и номер телефона и станьте участником розыгрыша.</h2>
        </div>
      </div>

      <div class="row third-row">
        <div class="col-md-12 text-center">
          <form method="POST">
            <input type="text" class="bfh-phone" name="userphone" placeholder="Телефон" required data-format="+7 (ddd) ddd-dd-dd"/>
            <input type="text" placeholder="ФИО" name="username" required/>
            <input type="submit" placeholder="ФИО" value="ХОЧУ КВАДРОКОПТЕР"/>
          </form>
        </div>
      </div>
    </div>

  <script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap-formhelpers.min.js"></script>
</body>
