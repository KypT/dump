<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-theme.min.css">
  <title>Esoft competition</title>
  <style>
    .background-1 {
      background-image: url(/assets/img/background-1.png);
      min-height: 345px;
    }

    .bootstrap-filestyle {
      display: inline-block;
    }

    .bootstrap-filestyle .btn.btn-default {
      display: inline-block;
      border-radius: 50px;
      border-color: rgb(152, 152, 152);
      border-width: 0.3px;
      border-style: solid;
      font-size: 18px;
      min-width: 244px;
      padding: 10px;
      background: white;
    }

    .background-1-text {
      background-color: #3799eb;
      padding-bottom: 30px;
    }

    .background-1-text p {
      color: white;
      font-size: 24px;
      margin: auto;
      max-width: 800px;
    }

    .main p, ol {
      font-size: 16px;
      max-width: 800px;
      margin:auto;
    }

    .dump-input {
      border-radius: 50px;
      border-color: rgb(152, 152, 152);
      border-width: 0.3px;
      border-style: solid;
      font-size: 18px;
      padding: 10px;
    }

    .dump-input-container {
      margin: 30px;
    }

    .submit-task-btn {
      background-color: #3799eb;
      color: white;
      border-radius: 50px;
      font-size: 18px;
      padding: 10px 70px;
      border: none;
    }

    input[type=file] {
        display: inline-block;
    }

    .download-btn {
      background-image: url(/assets/img/button2.png);
      width: 240px;
      height: 48px;
      display: inline-block;
      font-size: 26px;
      padding-top: 8px;
      padding-right: 50px;
      color: #757575;
    }

    .download-btn:hover {
      text-decoration: none;
      color: #757575;
    }

  </style>
</head>
<body>
  <div class="background-1">
  </div>
  <div class="background-1-text">
    <p class="text-center">
      Проверьте свои математические способности и быстроту ума в
      состязании от Esoft и выиграйте Мощный PowerBank. Победитель будет определен в
      конце конференции по числу баллов.
    </p>
  </div>
  <div class="container main">
    <h1 class="text-center">
      Что нужно сделать?
    </h1>
    <p class="text-center">
      Всего 3 задания - установить зависимость между набором исходных значений
      и полученным результатом. Чем больше заданий будет выполнено, тем выше
      вероятность победы. Каждое задание предоставляет 2 файла:
    </p>
    <br>
    <ol>
      <li><b>function.csv</b> - искомая функция, заданная табличным видом.
        Каждая строка данной таблицы показывает, какое значение искомая функция
        (последняя колонка) принимает на данном наборе входных параметров
        (все колонки, кроме последней)
      </li>
      <li>
        <b>task.csv</b> - набор входных параметров, для которых вам необходимо рассчитать
        значения искомой функции.
      </li>
    </ol>

    <div class="text-center dump-input-container">
      <a class="download-btn" href="/tasks/first/task1.zip">Задание 1</a>
    </div>

    <div class="text-center dump-input-container">
      <a class="download-btn" href="/tasks/second/task2.zip">Задание 2</a>
    </div>

    <div class="text-center dump-input-container">
      <a class="download-btn" href="/tasks/third/task3.zip">Задание 3</a>
    </div>

    <h1 class="text-center">
      Загрузите решение
    </h1>
    <p class="text-center">
      В качестве ответа на задание отправьте файл в формате csv, в котором каждая
      строка соответствует значению искомой функции, рассчитанной для
      соответствующей строки входных параметров из файла <b>task.csv</b>.
    </p>
  </div>

  <div class="container">
    <form method="post" enctype="multipart/form-data">

      <div class="text-center dump-input-container">
        <h3>Телефон</h3>
        <input type="text" id="phone-input" class="dump-input bfh-phone" name="userphone" value="<?php echo $_SESSION["userphone"]?>" required data-format="+7 (ddd) ddd-dd-dd">
      </div>

      <div class="text-center dump-input-container">
        <h3>ФИО</h3>
        <input type="text" class="dump-input" name="username" value="<?php echo $_SESSION["username"]?>" required placeholder="ФИО">
      </div>

      <div class="text-center dump-input-container">
          <h3>Задание 1</h3>
          <input type="file" class="dump-input" name="first">
          <p><?php echo $firstTaskMessage; ?></p>
      </div>

      <div class="text-center dump-input-container">
          <h3>Задание 2</h3>
          <input type="file" class="dump-input" name="second">
          <p><?php echo $secondTaskMessage; ?></p>
      </div>

      <div class="text-center dump-input-container">
          <h3>Задание 3</h3>
          <input type="file" class="dump-input" name="third">
          <p><?php echo $thirdTaskMessage; ?></p>
      </div>

      <div class="text-center dump-input-container">
        <input class="submit-task-btn" type="submit" value="Отправить">
      </div>
    </form>

  </div>

  <script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap-formhelpers.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap-filestyle.min.js"></script>
  <script>
    $(function() {
      $(":file").filestyle({input: false, buttonText: "Выбрать файл"});
    })
  </script>
</body>
