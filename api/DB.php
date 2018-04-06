<?php 	 
/**
* 
*/
class DB
{
	public static function sql($query)
    {
        $host = "localhost";
        $db = "api_rest"; // SET YOUR DB NAME HERE !!!
        $charset = "utf8";
        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host='.$host.';dbname='.$db.';charset='.$charset, $user, $pass);
        $sth = $dbh->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>