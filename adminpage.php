<?
session_start();
if(!$_SESSION['user'] OR $_SESSION['role']==0){
    echo "<script>document.location.href = './'</script>"; 
}
include_once('php/database.php');
include_once('php/admincontroller.php');
$db = new database();
$db->GetConnection();
$mysqli = $db->mysqli;
$controller = new  administration();
$marks = $controller->getMarks();
if(isset($_REQUEST['searchsubmit'])){
$marks = $controller->search();
}
if(isset($_REQUEST['resetsearch'])){
    $marks = $controller->getMarks();
}
$info = $controller->getInfo();
$controller->logout();
$controller->addUser();
$markdays = $controller->getDates();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Страница администратора</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Система учета рабочего времени</div>
            </a>
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Добро пожаловать</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >
                    <span><? echo $info[0][1];?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >
                    <span><? echo $info[0][2];?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >
                    <span><? echo $info[0][3];?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >
                    <span><? echo $info[0][4];?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >
                    <span><? echo $info[0][6];?></span></a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Пенсионый Фонд России</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/logo.png">
                            </a>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Учет рабочего времени</h1>
                    </div>
                        <form method="post"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <h1>Поиск</h1>
                            <input type="text" class="form-control border-0 small" placeholder="Фамилия" name = 'name' style = "margin-bottom: 1rem;">
                            <p><select name="month" class="form-control border-0 small">
                                <option value="01">Январь</option>
                                <option value="02">Февраль</option>
                                <option value="03">Март</option>
                                <option value="04">Апррель</option>
                                <option value="05">Май</option>
                                <option value="06">Июнь</option>
                                <option value="07">Июль</option>
                                <option value="08">Август</option>
                                <option value="09">Сентябрь</option>
                                <option value="10">Октябрь</option>
                                <option value="11">Ноябрь</option>
                                <option value="12">Декабрь</option>
                            </select></p>
                            <input type="submit" value="Найти" style = "margin-left:0;" name = "searchsubmit">
                        </form>
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Последние отметки</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <?if ($marks){?>
                                            <table class="table  table-responsive-sm tbl">
                                            <tr>
                                                <td>Фамилия</td>
                                                <td>Отметка</td>
                                                <td>Дата</td>
                                                <td>Время</td>
                                            </tr>
                                            <?
                                                foreach($marks as $mark){
                                                    echo "<tr>";
                                                        foreach($mark as $stat){
                                                            echo "<td>",$stat,"</td>";
                                                        }
                                                    echo "</tr>";
                                                }
                                            ?>
                                            </table>
                                        <?}else{
                                            echo 'Отметок ещё нет';
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <form method="post">
                    <input type="submit" value="Сброс фильтра" name = "resetsearch" >
                </form>
                <form method="post"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <h1>Поиск посещений</h1>
                            <input type="text" class="form-control border-0 small" placeholder="Фамилия" name = 'name' style = "margin-bottom: 1rem;">
                            <p><select name="month" class="form-control border-0 small">
                                <option value="01">Январь</option>
                                <option value="02">Февраль</option>
                                <option value="03">Март</option>
                                <option value="04">Апррель</option>
                                <option value="05">Май</option>
                                <option value="06">Июнь</option>
                                <option value="07">Июль</option>
                                <option value="08">Август</option>
                                <option value="09">Сентябрь</option>
                                <option value="10">Октябрь</option>
                                <option value="11">Ноябрь</option>
                                <option value="12">Декабрь</option>
                            </select></p>
                            <input type="submit" value="Найти" style = "margin-left:0;" name = "searchsubmit_days">
                        </form>
                        <?if(isset($_REQUEST['searchsubmit_days'])){?>
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Посещения за месяц</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <?if ($markdays){?>
                                            <table class="table-responsive-sm tbl">
                                            <tr>
                                                <td>Фамилия</td>
                                                <td>Дата</td>
                                            </tr>
                                            <?
                                                foreach($markdays as $mark){
                                                    echo "<tr>";
                                                        foreach($mark as $stat){
                                                            echo "<td>",$stat,"</td>";
                                                        }
                                                    echo "</tr>";
                                                }
                                            ?>
                                            </table>
                                        <?}else{
                                            echo 'Отметок ещё нет';
                                        }?>
                                    </div>
                                </div>
                            </div>
                            <?}?>
                        </div>
                <form method="post"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <h1>Добавление пользователя</h1>
                            <p><input type="text" class="form-control border-0 small" placeholder="Имя" name = 'name' style = "margin-bottom: 1rem;" required></p>
                            <p><input type="text" class="form-control border-0 small" placeholder="Отчество" name = 'midname' style = "margin-bottom: 1rem;" required></p>
                            <p><input type="text" class="form-control border-0 small" placeholder="Фамилия" name = 'lastname' style = "margin-bottom: 1rem;" required></p>
                            <p><input type="email" class="form-control border-0 small" placeholder="Email" name = 'email' style = "margin-bottom: 1rem;" required></p>
                            <p><input type="text" class="form-control border-0 small" placeholder="Пароль" name = 'password' style = "margin-bottom: 1rem;" required></p>
                            <p><input type="text" class="form-control border-0 small" placeholder="Должность" name = 'position' style = "margin-bottom: 1rem;" required></p>
                            <p><select name="role" class="form-control border-0 small">
                                <option value="0">Сотрудник</option>
                                <option value="1">Администратор</option>
                            </select></p>
                            <p><input type="submit" value="Добавить" style = "margin-left:0;" name = "adduser"></p>
                </form>
                <form method="post">
                    <input type="submit" value="Выйти из системы" name = "logout">
                </form>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy;Пенсионый Фонд России</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="script/jquery.min.js"></script>
    <script src="script/bootstrap.bundle.min.js"></script>
</body>
</html>