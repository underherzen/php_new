<?php

#namespace connectdb;


class connectdb
{
    protected static $host = 'laravel';
    protected static $user = 'root';
    protected static $pass = '';
    protected static $db = 'underher_users';
    protected static $conn;
    public static function todb()
    {
        return self::$conn=new \mysqli(self::$host, self::$user, self::$pass, self::$db);
    }
}#endofclass