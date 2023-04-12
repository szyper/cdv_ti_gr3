<!doctype html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/table.css">
  <title>Użytkownicy</title>
</head>
<body>
<h4>Użytkownicy</h4>
<?php
  if (isset($_GET["userIdDelete"])){
    if ($_GET["userIdDelete"] == 0){
      echo "<h4>Nie udało się usunąć rekordu!</h4>";
    }else{
	    echo "<h4>Usunięto rekord id = $_GET[userIdDelete]</h4>";
    }
  }
?>

<table>
  <tr>
    <th>Imię</th>
    <th>Nazwisko</th>
    <th>Data urodzenia</th>
    <th>Miasto</th>
    <th>Województwo</th>
  </tr>

<?php
  require_once "./scripts/connect.php";
  $sql = "SELECT u.id userId, u.firstName, u.lastName, u.birthday, c.city, s.state FROM `users` u JOIN `cities` c ON `u`.`city_id`=`c`.`id` JOIN `states` s ON `c`.`state_id`=`s`.`id`;";
  $result = $conn->query($sql);
  //echo $result->num_rows;

  if ($result->num_rows == 0){
    echo "<tr><td colspan='100%'>Brak rekordów do wyświetlenia</td></tr>";
  }else{
	  while($user = $result->fetch_assoc()){
		  echo <<< TABLEUSERS
      <tr>
        <td>$user[firstName]</td>
        <td>$user[lastName]</td>
        <td>$user[birthday]</td>
        <td>$user[city]</td>
        <td>$user[state]</td>
        <td><a href="./scripts/delete_user.php?userDeleteId=$user[userId]">Usuń</a></td>
      </tr>
TABLEUSERS;
	  }
  }
  echo "</table><hr>";
  $conn->close();
?>
  <a href="./4_db_table_delete_add.php">Dodaj użytkownika</a>
</body>
</html>