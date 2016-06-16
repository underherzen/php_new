<?php

#namespace connectdb;


class connectdb
{
    protected static $host = 'laravel';
    #define("DB_DRIVER", "mysql");
    protected static $DB_DRIVER = 'mysql';
    protected static $user = 'root';
    protected static $password = '';
    protected static $db = 'underher_users';
    protected static $connection = null;
    private $dbh = null;
    public static function getInstance() {

        // Ïðîâåðÿåì ñîäåðæèòñÿ ëè â ïåðåìåííîé $connection
        // handler (êîííåêòîð äëÿ ðàáîòû ñ ÁÄ)
        if (empty(self::$connection)) {
            self::$connection = new self(); // === $connection = new Connection()
        }
        return self::$connection;
    }
    public function connect() {

        if (!(self::$connection->dbh instanceof PDO)) {

            try {
               # $dsn = "mysql:host=mysql.hostinger.ru";
                self::$connection->dbh = new PDO(self::$DB_DRIVER.":host=".self::$host . ";dbname=" . self::$db, self::$user, self::$password);
                self::$connection->dbh->exec("SET CHARACTER SET utf8");
                self::$connection->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$connection->dbh;
            }
            catch (PDOException $e) {
                echo '<br>Ошибка подключения' . $e->getMessage(). '<br>';
            }
        }
        else {
            return self::$connection->dbh;
        }
    }
}
#endofclass