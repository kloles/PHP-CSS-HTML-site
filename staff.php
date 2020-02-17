<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Админ-панель</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
		<div>
			<header>
				<div class = "title"><a href = "site.html">LerochkaAIRline</a></div>
			</header>
		</div>
		<h1></h1>
	</head>
<body>
<form action="" method="post">
    <table class="tablet" >
	<caption>Добавьте нового сотрудника</caption>
      <tr>
        <td>ФИО</td>
        <td><input type="text" name="name" pattern="^[А-Я][А-Яа-яЁё\s]+$" value="<?= isset($_GET['red_id']) ? $staf['name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Вакансия</td>
        <td><input type="text" name="vac" pattern="^[А-Я][А-Яа-яЁё\s]+$" value="<?= isset($_GET['red_id']) ? $staf['vac'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Стаж</td>
        <td><input type="date"  name="expi" value="<?= isset($_GET['red_id']) ? $staf['expi'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Дата рождения</td>
        <td><input type="date" name="date" value="<?= isset($_GET['red_id']) ? $staf['date'] : ''; ?>"></td>
      </tr>
      <tr>
        <td colspan="2"><input  type="submit" id ="try" value="OK" onclick='showMessage()'></td>
      </tr>
	  <script type="text/javascript">

</script>
    </table>
  </form>
  <h1></h1>
  <?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'user';    // Имя созданного вами пользователя
    $pass = 'lera'; // Установленный вами пароль пользователю
    $db_name = 'staff';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

    if (isset($_POST["name"])) {
          $sql = mysqli_query($link, "INSERT INTO `staf` (`name`, `vac`, `expi`, `date`) VALUES ('{$_POST['name']}', '{$_POST['vac']}', '{$_POST['expi']}','{$_POST['date']} ')");
      }

    if (isset($_GET['del_id'])) {
      $sql = mysqli_query($link, "DELETE FROM `staf` WHERE `ID` = {$_GET['del_id']}");
   }
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `name`, `timeto`, `timear`, `cityof`, `cityar`, `staf` FROM `flight` WHERE `ID`={$_GET['red_id']}");
      $staf = mysqli_fetch_array($sql);
    }
  ?>
  <table class="table">
  <caption>Список сотрудников</caption>
  
    <tr>
      <th>ФИО</th>
      <th>Вакансия</th>
      <th>Стаж</th>
      <th>Дата рождения</th>
	  <th>Удалить</th>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `ID`, `name`, `vac`, `expi`, `date` FROM `staf`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             
             "<td>{$result['name']}</td>" .
             "<td>{$result['vac']} </td>" .
			 "<td>{$result['expi']} </td>" .
			 "<td>{$result['date']} </td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
</body>
</html>