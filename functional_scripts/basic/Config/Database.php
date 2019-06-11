<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function setDbInstance()
{
    $host = 'www59.totaalholding.nl';
    $port = '3306';
    $database = 'subatomisch_di_tools';
    $username = 'subatomisch_dita';
    $password = 'CWx*xss6LB{L';
    $charset = 'latin1';

    $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database . ';';

	try {
        $dbInstance = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    return $dbInstance;
}

function setSitemap($nodeId = null)
{
    $dbInstance = getDbInstance();
    $select = 'SELECT * ';
    $from = 'FROM sitemap ';
    $where = '';
    if($nodeId != null) {
        $where = 'WHERE nodeId = ' . $nodeId . ' ';
    }
    $order = 'ORDER BY level, sort';
    $query = $select . $from . $where . $order;

    if($nodeId != null) {
        $result = $dbInstance->query($query)->fetch(PDO::FETCH_OBJ);
    }
    else {
        $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_OBJ);
    }

    return $result;
}

function setMenu()
{
    $dbInstance = getDbInstance();
    $select = 'SELECT * ';
    $from = 'FROM sitemap ';
    $where = 'WHERE isMenuItem = 1 ';
    $order = 'ORDER BY level, sort';
    $query = $select . $from . $where . $order;

    $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_OBJ);

    return $result;
}
?>