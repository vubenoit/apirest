<?php  
require("rest.php");
/**
* Public method for access api.
* This method dynmically call the method based on the query string
* */
public function processApi($func){
   $func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
   if((int)method_exists($this,$func) > 0) $this->$func();
   else $this->response('',404); // si la fonction n’existe pas, la réponse sera "Page not found".
}
?>