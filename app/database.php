<?php
/* ---------- database.php ---------- */
require_once __DIR__ . '/core/config.php';

function db_connect() {
    try { 
        $dbh = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $dbh;
    } catch (PDOException $e) {
        //We should set a global variable here so we know the DB is down
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}

// Add the db() function that your existing code expects
function db() {
    return db_connect();
}