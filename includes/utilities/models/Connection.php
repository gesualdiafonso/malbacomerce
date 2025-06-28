<?php
class Connection 
{
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = 'root';
    private const DB_NAME = 'malba_db';

    private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    private PDO $db;

    public static function getConnection():PDO
    {
        try{
            $db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        }catch(Exception $e){
            die('Error al conectar con MySQL.');
        }
        return $db;
    }
}