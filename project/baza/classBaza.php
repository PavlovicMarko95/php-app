<?php
class Baza{
    private static $db;
    public function __construct(){
        $this->connect();
    }
    public function __destruct(){
        //mysqli_close(static::$db);
    }
    public function connect(){
        static::$db=@mysqli_connect("localhost", "root", "", "vesti");
        if(!static::$db) return false;
        $this->query("SET NAMES utf8");
        return static::$db;
    }
    public function query($upit){
        return mysqli_query(static::$db, $upit);
    }
    public function escapeString($string){
        return mysqli_real_escape_string(static::$db, $string);
    }
    public function fetch_assoc($rez){
        return mysqli_fetch_assoc($rez);
    }
    public function fetch_object($rez){
       return mysqli_fetch_object($rez);
    }
    public function error(){
        return mysqli_error(static::$db);
    }
    public function errno(){
        return mysqli_errno(static::$db);
    }
    public function num_rows($rez){
        return mysqli_num_rows($rez);
    }
}