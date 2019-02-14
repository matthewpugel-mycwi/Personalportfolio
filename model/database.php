<?php
/*class Database {
    private static $dsn = 'mysql:host=localhost;dbname=mpworks';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;
    
    private function __construct() {}
    
    public static function getDB() {
        if (!isset(self::$db)){
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);

            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                /* include('database_error.php'); */
              //  echo "DB Error: " . $error_message; 
                //exit();
           /* }
        }
        return self::$db;
    }
}  */

 $dsn = 'mysql:host=localhost;dbname=mpworks';
    $username = 'root';
    $password = 'Pa$$w0rd';
    $db;
             try {
        $db = new PDO($dsn, $username, $password);

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('error.php');
        echo "DB Error: " . $error_message; 
        exit();
        } 
    
?>