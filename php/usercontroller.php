<?
class controller{
    public $name;
    public $email;
    public $info;
    public $type;
    function getInfo(){
        global $mysqli;
        $this->email = $_SESSION['user'];
        $this->info = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$this->email'");
        $this->info = mysqli_fetch_all($this->info);
        return $this->info;
    }
    function SetMarks(){
        global $mysqli;
        $this->email = $_SESSION['user'];
        if(isset($_REQUEST['StartMark'])){
            $this->name = $mysqli->query("SELECT `lastname` FROM `users` WHERE `email` = '$this->email'");
            $this->name = mysqli_fetch_array($this->name)[0];
            $this->type = "Начал работу";
            $mysqli->query("INSERT INTO `accounting`(`name`,`email`,`type`) VALUES('$this->name','$this->email','$this->type')");
        }
        if(isset($_REQUEST['EndMark'])){
            $this->name = $mysqli->query("SELECT `lastname` FROM `users` WHERE `email` = '$this->email'");
            $this->name = mysqli_fetch_array($this->name)[0];
            $this->type = "Завершил работу";
            $mysqli->query("INSERT INTO `accounting`(`name`,`email`,`type`) VALUES('$this->name','$this->email','$this->type')");
        }
    }
    function getMarks(){
        global $mysqli;
        $this->email = $_SESSION['user'];
        $this->info = $mysqli->query("SELECT `type`,date(`date`),time(`date`) FROM `accounting` WHERE `email` = '$this->email' ORDER BY `date` DESC LIMIT 5");
        $this->info = mysqli_fetch_all($this->info);
        if($this->info){
            return $this->info;
        }else{
            return null;
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