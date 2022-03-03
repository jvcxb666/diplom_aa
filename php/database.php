<?
class database{
    public $db;
    public $mysqli;

    function GetConnection(){
        $this->mysqli = new mysqli("localhost","root","","pfr");
    }
}
?>