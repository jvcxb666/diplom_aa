<?
  session_start();
  include_once('php/database.php');
  include_once('php/authorization.php');
  $db = new database();
  $db->GetConnection();
  $mysqli = $db->mysqli;
  $auth = new authorization();
  $auth->auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система учета часов</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first">
      <img src="assets/img/logo.png" alt="User Icon" width = "40%" height = "30%" />
    </div>
    <form method = "POST">
      <input type="email" id="login" class="fadeIn second" name="email" placeholder="Адрес эл-почты" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Пароль" required>
      <input type="submit" class="fadeIn fourth" value="Войти" name = "login">
    </form>
    <div id="formFooter">
      <a>©Пенсионый Фонд России</a>
    </div>
  </div>
</div>
</body>
</html>