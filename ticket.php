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
	<caption>Добавьте новый билет</caption>
      <tr>
        <td>Номер билета</td>
        <td><input type="number" name="num" value="<?= isset($_GET['red_id']) ? $ticket['num'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Рейс</td>
        <td><input type="text" name="flig"  pattern="[A-Z]{2}+[0-9]{4}" value="<?= isset($_GET['red_id']) ? $ticket['flig'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>ФИО пассажира</td>
        <td><input type="text"  name="pas" pattern="^[А-Я][А-Яа-яЁё\s]+$" value="<?= isset($_GET['red_id']) ? $ticket['pas'] : ''; ?>"></td>
      </tr>
	  <tr>
        <td>Дата и время отлёта</td>
        <td><input type="datetime-local" name="date" value="<?= isset($_GET['red_id']) ? $ticket['date'] : ''; ?>"></td>
      </tr>
      <tr>
        <td colspan="2"><input  type="submit" id ="try" value="OK" onclick='showMessage()'></td>
      </tr>
	  <script type="text/javascript">
function showMessage()
{
alert('Вы уверенны что хотите добавить данные?')
}
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

    if (isset($_POST["num"])) {
          $sql = mysqli_query($link, "INSERT INTO `ticket` (`num`, `flig`, `pas`, `date`) VALUES ('{$_POST['num']}', '{$_POST['flig']}', '{$_POST['pas']}','{$_POST['date']} ')");
      }
    

    if (isset($_GET['del_id'])) { 
      $sql = mysqli_query($link, "DELETE FROM `ticket` WHERE `ID` = {$_GET['del_id']}");

    }
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `num`, `flig`, `pas`, `date` FROM `ticket` WHERE `ID`={$_GET['red_id']}");
      $product = mysqli_fetch_array($sql);
    }
  ?>
  <table class="table">
  <caption>Список сотрудников</caption>
  
    <tr>
      <th>Номер билета</th>
      <th>Рейс</th>
      <th>ФИО пассажира</th>
      <th>Дата и время отлёта</th>
	  <th>Удалить</th>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `ID`, `num`, `flig`, `pas`, `date` FROM `ticket`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             
             "<td>{$result['num']}</td>" .
             "<td>{$result['flig']} </td>" .
			 "<td>{$result['pas']} </td>" .
			 "<td>{$result['date']} </td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             '</tr>';
      }
    ?>

  </table>
</body>
</html>