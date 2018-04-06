<?php

require_once dirname(__FILE__)."/../config.php";

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/api/domain.[{ext}]', function (Request $req, Response $res, array $args) {

    $results = DB::fetchAll("SELECT id, slug, name, description from domain");

	if (!isset($args["ext"])) {
		$json_err = ["code" => 400, "message" => "Extension required"];
		return $res->withStatus($json_err["code"])->write(json_encode($json_err))->withHeader('Content-type', 'application/json');
	}else if($args["ext"] != "json"){
		$json_err = ["code" => 400, "message" => "unknow extension ".$args["ext"]];
		return $res->withStatus($json_err["code"])->write(json_encode($json_err))->withHeader('Content-type', 'application/json');
	}else if(!$results){
        $json_err = ["code" => 500, "message" => "internal Server Error ".$args["ext"]];
        return $res->withStatus($json_err["code"])->write(json_encode($json_err))->withHeader('Content-type', 'application/json');

    }


	$json_res = array(
		"code" => 200,
		"message" => "success",
		"datas" => $results,
	);

    return $res->withStatus($json_res["code"])->write(json_encode($json_res))->withHeader('Content-type', 'application/json');
});

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $json_err = ["code" => 404, "message" => "Not Found"];
		return $response->withStatus($json_err["code"])->write(json_encode($json_err))->withHeader('Content-type', 'application/json');
    };
};
/*$app->notFound(function (Request $req, Response $res) {

	$json_err = ["code" => 404, "message" => "Not Found"];
	return $res->withStatus($json_err["code"])->write(json_encode($json_err))->withHeader('Content-type', 'application/json');

});*/

?>