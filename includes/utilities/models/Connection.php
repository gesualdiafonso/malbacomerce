<?php
class Connection 
{
    //private const DB_HOST = 'localhost';
    //private const DB_USER = 'root';
    //private const DB_PASS = 'root';
    //private const DB_NAME = 'malba_db';

    //private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    //private PDO $db;

    //public static function getConnection():PDO
    //{
    //    try{
    //        $db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
    //    }catch(Exception $e){
    //        die('Error al conectar con MySQL.');
    //    }
    //    return $db;
    //}
    private static function getDSN(): string
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'malba_db';
        $charset = 'utf8mb4';

        return "mysql:host=$host;dbname=$dbname;charset=$charset";
    }

    public static function getConnection(): PDO
    {
        $dsn = self::getDSN();
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: 'root';

        try {
            $db = new PDO($dsn, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            die('Erro ao conectar com MySQL: ' . $e->getMessage());
        }
    }
}
