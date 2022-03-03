<?
    class administration{
        public $name;
        public $midname;
        public $lastname;
        public $email;
        public $password;
        public $position;
        public $role;
        public $info;
        public $month;
        public $marks;

        function getInfo(){
            global $mysqli;
            $this->name = $_SESSION['user'];
            $this->info = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$this->name'");
            $this->info = mysqli_fetch_all($this->info);
            return $this->info;
        }

        function search(){
            if(isset($_REQUEST['searchsubmit'])){
                global $mysqli;
                $this->name = $_POST['name'];
                $this->month = $_POST['month'];
                    if($this->name){
                        $this->marks = $mysqli->query("SELECT `name`,`type`,date(`date`),time(`date`) FROM `accounting` WHERE `name` = '$this->name' AND MONTH(`date`) = '$this->month'  ORDER BY `date` DESC LIMIT 5");
                    }else{
                        $this->marks = $mysqli->query("SELECT `name`,`type`,date(`date`),time(`date`) FROM `accounting` WHERE MONTH(`date`) = '$this->month'  ORDER BY `date` DESC LIMIT 5"); 
                    }
                $this->marks = mysqli_fetch_all($this->marks);
                return $this->marks;
            }
        }

        function getMarks(){
            global $mysqli;
            $this->marks = $mysqli->query("SELECT `name`,`type`,date(`date`),time(`date`) FROM `accounting` ORDER BY `date` DESC LIMIT 5");
            $this->marks = mysqli_fetch_all($this->marks);
            return $this->marks;
        }

        function getDates(){
            if(isset($_REQUEST['searchsubmit_days'])){
                global $mysqli;
                $this->name = $_POST['name'];
                $this->month = $_POST['month'];
                    if($this->name){
                        $this->marks = $mysqli->query("SELECT `name`,day(`date`) FROM `accounting` WHERE `name` = '$this->name' AND MONTH(`date`) = '$this->month' AND `type` = 'Начал работу'");
                    }else{
                        $this->marks = $mysqli->query("SELECT `name`,day(`date`) FROM `accounting` WHERE MONTH(`date`) = '$this->month' AND `type` = 'Начал работу'"); 
                    }
                $this->marks = mysqli_fetch_all($this->marks);
                return $this->marks;
            }
        }
        
        function addUser(){
            if(isset($_REQUEST['adduser'])){
                global $mysqli;
                $this->name = $_POST['name'];
                $this->midname = $_POST['midname'];
                $this->lastname = $_POST['lastname'];
                $this->email = $_POST['email'];
                $this->password = $_POST['password'];
                $this->position = $_POST['position'];
                $this->role = $_POST['role'];
                $check = $mysqli->query("SELECT `email` FROM `users` WHERE `email` = '$this->email'");
                $check = mysqli_fetch_array($check)[0];
                if(!$check){
                    $mysqli->query("INSERT INTO `users`(`name`, `midname`, `lastname`, `email`, `password`, `position`, `role`) VALUES ('$this->name','$this->midname','$this->lastname','$this->email','$this->password','$this->position','$this->role')");
                    echo "<script>alert('Успешно добавлен сотрудник')</script>";
                }else{
                    echo "<script>alert('Email уже занят.')</script>";
                }
            }
        }

        function logout(){
            if(isset($_REQUEST['logout'])){
                $_SESSION['user'] = null;
                $_SESSION['role'] = null;
                echo "<script>document.location.href = 'index'</script>";
            }
        }
    }
?>