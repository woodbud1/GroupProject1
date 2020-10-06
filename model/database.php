<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Dylan
 */
class database {
    
    
    private static $dsn = 'mysql:host=localhost;dbname=mathwiz';
    private static $username = 'root';
    private static $password = '';
    private static $db;

    private function __construct() {
        
    }
    
    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                $errorMessage = $ex->getMessage();
                include('../database_error.php');
                
                exit();
            }
        }
        return self::$db;
    }
}
