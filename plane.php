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
	<caption>Добавьте новый самолёт</caption>
      <tr>
        <td>Название самолёта</td>
        <td><input type="text" name="name" value="<?= isset($_GET['red_id']) ? $plane['name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Время в эксплуатации</td>
        <td><input type="date" name="time" value="<?= isset($_GET['red_id']) ? $plane['time'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Последняя проверка</td>
        <td><input type="date"  name="chek" value="<?= isset($_GET['red_id']) ? $plane['check'] : ''; ?>"></td>
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
          $sql = mysqli_query($link, "INSERT INTO `plane` (`name`, `time`, `chek`) VALUES ('{$_POST['name']}', '{$_POST['time']}', '{$_POST['chek']}')");
      }
    

    if (isset($_GET['del_id'])) { 
      $sql = mysqli_query($link, "DELETE FROM `plane` WHERE `ID` = {$_GET['del_id']}");
    }


    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `name`, `time`, `chek` FROM `plane` WHERE `ID`={$_GET['red_id']}");
      $staf = mysqli_fetch_array($sql);
    }
  ?>
  <table class="table">
  <caption>Список билетов</caption>
    <tr>
      <th>Название самолёта</th>
      <th>Время в эксплуатации</th>
      <th>Последняя проверка</th>
	  <th>Удалить</th>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `ID`, `name`, `time`, `chek` FROM `plane`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             
             "<td>{$result['name']}</td>" .
             "<td>{$result['time']} </td>" .
			 "<td>{$result['chek']} </td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
</body>
</html>