<?php
    define("URL", "http://example.com");
    define("PATH", dirname(__FILE__));

    define("DB_USER", "DB_USER");
    define("DB_PASS", "DB_PASS");
    define("DB_HOST", "DB_HOST");
    define("DB_NAME", "DB_NAME");

    try{
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    } catch(PDOException $e) {
        die( $e->getMessage() );
    }