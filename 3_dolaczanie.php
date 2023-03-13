<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h4>Początek strony</h4>
  <?php
    //require, require_once, include, include_once
    include "./scripts/list.php";
    @include_once "./scripts/list111.php";

    echo "<br>Require<br>";
    require "./scripts/list.php";
    require_once "./scripts/list.php";
    @require "./scripts/list1111.php";

  ?>
  <h4>Koniec strony</h4>

</body>
</html>