<?php 	 
require_once dirname(__FILE__)."/../config.php";
/**
* 
*/
class DB
{
	public static function fetchAll($query)
    {
        try{
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWD);
        $sth = $dbh->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);

        } catch(Exception $e) {
            return false;
        }

    }

    public static function fetch($query)
    {
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWD);
        $sth = $dbh->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC)[0];
    }
/*
    public static function exec($query)
    {
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWD);
        $sth = $dbh->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC)[0];
    }*/

}
?>