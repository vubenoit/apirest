<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/DB.php';

$app = new Silex\Application();
$app['debug'] = true;

// ********* README *****************
/* $app est une variable qui représente toute l'API
*
* ->get/->post/->put/ etc... représente la méthode qui est accepté pour utilisé pour executer le code de la route
*
* Premier paramètre : La route qu'on souhaite capturer. ex "/api/maressource/{id}". Tout ce qui est entre accollade veux dire que c'est une * variable, est que la route est donc dynamique à ce niveaux la (voir: https://silex.symfony.com/doc/2.0/providers/routing.html )
*
* Second paramètre : fonction avec en paramètre les variables récupérées dans la route (si il y a des variables dynamique) (je vous laisse vous documenter)
*
*/

// ************************ EXEMPLE ROUTE 1 *********************
$app->get('/', function() {
    $var1 = DB::sql('SELECT `id`,`slug`,`name`,`description` FROM `domain`');
	// Tableau de reponse
  	$res = array(
    	"code" => 200,
    	"message" => "success",
    	"datas" => array($var1)
    );

  	// Envoi de la réponse (Contenu Réponse encodé en JSON, Code HTTP, Entêtes json)
    $response = new Response(json_encode($res), $res["code"], ["Content-Type" => "application/json"]);
    return $response;
});




// ************************ EXEMPLE ROUTE 2 ***************************
$app->get('/domain/', function() {
	// CODE
	// Exemple Requete SQL
  	$result = DB::sql("SELECT * FROM domain");
  	//ENDCODE

	// Tableau de reponse
  	$res =	array(
    	"code" => 200,
    	"message" => "success",
    	"datas" => $result
    );

  	// Envoi de la réponse (Contenu Réponse encodé en JSON, Code HTTP, Entêtes json)
    $response = new Response(json_encode($res), $res["code"], ["Content-Type" => "application/json"]);
    return $response;
});





// ************************* EXEMPLE ROUTE 3 *******************************
$app->get('/domain.{ext}', function($ext) {

	// Tableau de reponse
	if ($ext != "xml") {
		$res = array(
	    	"code" => 200,
	    	"message" => "success",
	    	"datas" => "L'extension est ".$ext,
	    );
	} else {
		$res = array(
	    	"code" => 400,
	    	"message" => "Non Non Non, Surtout pas de XML comme extension (C'est un exemple)",
	    	"datas" => array(),
	    );
	}

  	// Envoi de la réponse (Contenu Réponse encodé en JSON, Code HTTP, Entêtes json)
    $response = new Response(json_encode($res), $res["code"], ["Content-Type" => "application/json"]);
    return $response;
});





// ************************* ERREUR 404 *******************************
$app->error(function ($e) {
	// Tableau de reponse
	$res = array(
    	"code" => 404,
    	"message" => "Not Found $e",
    );

  	// Envoi de la réponse (Contenu Réponse encodé en JSON, Code HTTP, Entêtes json)
    $response = new Response(json_encode($res), $res["code"], ["Content-Type" => "application/json"]);
    return $response;
});

$app->run();