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
	<caption>Добавьте новый рейc</caption>
      <tr>
        <td>Номер рейса</td>
        <td><input type="number" name="name" value="<?= isset($_GET['red_id']) ? $flight['name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Время отправления</td>
        <td><input type="datetime-local" name="timeto" value="<?= isset($_GET['red_id']) ? $timeto['timeto'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Время прибытия</td>
        <td><input type="datetime-local"  name="timear" value="<?= isset($_GET['red_id']) ? $flight['timear'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Город отправления</td>
        <td><input type="text" name="cityof" pattern="^[А-Я][А-Яа-яЁё]+$" value="<?= isset($_GET['red_id']) ? $flight['cityof'] : ''; ?>"></td>
      </tr>
	   <tr>
        <td>Город прибытия</td>
        <td><input type="text" name="cityar" pattern="^[А-Я][А-Яа-яЁё]+$" value="<?= isset($_GET['red_id']) ? $flight['cityar'] : ''; ?>"></td>
      </tr>
	   <tr>
        <td>Состав экипажа</td>
        <td><input type="text" name="staf" value="<?= isset($_GET['red_id']) ? $flight['staf'] : ''; ?>"></td>
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
    $host = 'localhost';
    $user = 'user'; 
    $pass = 'lera';
    $db_name = 'staff';  
    $link = mysqli_connect($host, $user, $pass, $db_name); 

    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
    if (isset($_POST["name"])) {
          $sql = mysqli_query($link, "INSERT INTO `flight` (`name`, `timeto`, `timear`, `cityof`, `cityar`, `staf`) VALUES ('{$_POST['name']}', '{$_POST['timeto']}', '{$_POST['timear']}','{$_POST['cityof']}', '{$_POST['cityar']}', '{$_POST['staf']}')");
      }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `flight` WHERE `ID` = {$_GET['del_id']}");
    }

    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `name`, `timeto`, `timear`, `cityof`, `cityar`, `staf` FROM `flight` WHERE `ID`={$_GET['red_id']}");
      $staf = mysqli_fetch_array($sql);
    }
  ?>
  <table class="table">
  <caption>Список рейсов</caption>
  
    <tr>
      <!--<td>Номер</td>-->
      <th>Номер рейса</th>
      <th>Время отправления</th>
      <th>Время прибытия</th>
      <th>Город отправления</th>
	  <th>Город прибытия</th>
	  <th>Состав экипажа</th>
	  <th>Удалить</th>
	  <!--<td>Редактировать</td>-->
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `ID`, `name`, `timeto`, `timear`, `cityof`, `cityar`, `staf` FROM `flight`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             
             "<td>{$result['name']}</td>" .
             "<td>{$result['timeto']} </td>" .
			 "<td>{$result['timear']} </td>" .
			 "<td>{$result['cityof']} </td>" .
			 "<td>{$result['cityar']} </td>" .
			 "<td>{$result['staf']} </td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             //"<td><a href='?red_id={$result['ID']}'>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
</body>
</html>