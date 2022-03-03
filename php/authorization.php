<?
    class authorization{
        public $email;
        public $password;
        public $role;
        public $check;

        function auth(){
            if(isset($_REQUEST['login'])){
                global $mysqli;
                $this->email = $_POST['email'];
                $this->password = $_POST['password'];
                $this->check = $mysqli->query("SELECT `password` FROM `users` WHERE `email` = '$this->email'");
                $this->check = mysqli_fetch_array($this->check)[0];
                if($this->check and $this->password == $this->check){
                    $this->role = $mysqli->query("SELECT `role` FROM `users` WHERE `email` = '$this->email'");
                    $this->role = mysqli_fetch_array($this->role)[0];
                    $_SESSION['user'] = $this->email;
                    $_SESSION['role'] = $this->role;
                    if($this->role == 0){
                        echo "<script>document.location.href = 'userpage'</script>";
                    }else{
                        echo "<script>document.location.href = 'adminpage'</script>";
                    }
                }else{
                    
                    echo "<script>alert('Неверные данные для входа')</script>";
                }
            }
        }
    }
?>