<?
session_start();
if(!$_SESSION['user']){
    echo "<script>document.location.href = './'</script>"; 
 }
include_once('php/database.php');
include_once('php/usercontroller.php');
$db = new database();
$db->GetConnection();
$mysqli = $db->mysqli;
$user = new controller();
$info = $user->getInfo();
$user->SetMarks();
$marks = $user->getMarks();
$user->logout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Страница сотрудника</title>
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
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Учет рабочего времени</h1>
                        
                    </div>
                    <div class = "row">
                        <form method="post">
                            <input type="submit" value="Начал работу" name = "StartMark">
                        </form>
                        <form method="post">
                            <input type="submit" value="Завершил работу" name = "EndMark">
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Последние отметки</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <?if ($marks){?>
                                            <table class="table table-responsive-sm tbl">
                                            <tr>
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
                </div>
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
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="script/jquery.min.js"></script>
    <script src="script/bootstrap.bundle.min.js"></script>


</body>

</html>