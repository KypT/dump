<?php
  session_start();

  $conf = include "conf.php";
  $db = new \PDO ( $conf['dsn'], $conf['user'], $conf['pass'], [
      \PDO::ATTR_PERSISTENT         => true,
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  ]);

  $insertStatement = $db->prepare("insert into assignment_results values(?, ?, ?, ?, ?)");

  function evaluateAnswer($answer, $task, $function) {
    $error = 0;

    if (count($answer) != count($task)) {
      throw new Exception("Количество строк загруженного файла не соответствует количеству строк файла task.csv");
    }

    for ($i = 0; $i < count($task); $i++) {
      $correct = call_user_func_array($function, $task[$i]);
      $delta = abs($answer[$i][0] - $correct);
      $error += $delta / abs($correct);
    }

    return $error / count($task);
  }

  function readCsv($file) {
    $answers = [];
    $handle = fopen($file, "r");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $answers[] = [];
      foreach ($data as $number) {
        if (!filter_var($number, FILTER_VALIDATE_FLOAT)) {
          throw new Exception("Неверный формат: в csv допустимы только числа с плавающей точкой, разделяемые запятыми");
        }
        $answers[count($answers)  - 1][] = (float) $number;
      }
    }

    fclose($handle);
    return $answers;
  };

  function readAnswers($file) {
    if (isset($_FILES[$file]) && $_FILES[$file]["error"] !== 4) {
      if ($_FILES[$file]["error"] !== 0) {
        error_log("Error uploading file: ".$_FILES[$file]["error"]);
        throw new Exception("При загрузке файла возникли ошибки");
      }

      if ($_FILES[$file]["type"] !== 'text/csv') {
        throw new Exception("Ожидается файл в формате csv");
      }

      return readCsv($_FILES[$file]["tmp_name"]);
    }

    return null;
  }

  function checkAnswer($task, $answerFn) {
    try {
        $answer = readAnswers($task);
        if ($answer) {
            $task = readCsv(getcwd()."/tasks/$task/task.csv");
            $error = evaluateAnswer($answer, $task, $answerFn);
            return ["Задание принято!", $error];
        }
      } catch(Exception $e) {
        return [$e->getMessage(), null];
      }

    return ["", null];
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $userphone = htmlspecialchars($_POST["userphone"]);

    $_SESSION["username"]  = $username;
    $_SESSION["userphone"] = $userphone;

    $firstTaskResult = checkAnswer("first", function($q1, $q2, $r) {
      return 8.99 * $q1 * $q2 / $r / $r;
    });

    $secondTaskResult = checkAnswer("second", function($x, $A, $p, $o) {
      return $A * sin($x * $p + $o);
    });

    $thirdTaskResult = checkAnswer("third", function($x, $o, $m, $extra) {
      return pow(M_E, - ($x - $m) * ($x - $m) / 2 / $o / $o) / sqrt(2 * M_PI * $o * $o);
    });

    $insertStatement->execute([$userphone, $username, $firstTaskResult[1], $secondTaskResult[1], $thirdTaskResult[1]]);

    $firstTaskMessage = $firstTaskResult[0];
    $secondTaskMessage = $secondTaskResult[0];
    $thirdTaskMessage = $thirdTaskResult[0];
  } else {
    $firstTaskMessage = "";
    $secondTaskMessage = "";
    $thirdTaskMessage = "";
  }

  include("page.php");
