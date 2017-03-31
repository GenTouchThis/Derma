<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));
date_default_timezone_set('America/Mexico_City');

$app->get('/', function () use ($app) {
	return $app['twig']->render('pages/index.twig.html', array());
})->bind('inicio');

$app->get('/laboratorios', function () use ($app) {
	return $app['twig']->render('pages/laboratorios.twig.html', array());
})->bind('laboratorios');

$app->get('/programa', function () use ($app) {
	return $app['twig']->render('pages/programa.twig.html', array());
})->bind('programa');

$app->get('/cdmx', function () use ($app) {
	return $app['twig']->render('pages/cdmx.twig.html', array());
})->bind('cdmx');

$app->get('/sede', function () use ($app) {
	return $app['twig']->render('pages/sede.twig.html', array());
})->bind('sede');

$app->get('/hospedaje', function () use ($app) {
	return $app['twig']->render('pages/hospedaje.twig.html', array());
})->bind('hospedaje');

$app->get('/exposicion', function () use ($app) {
	return $app['twig']->render('pages/exposicion.twig.html', array());
})->bind('exposicion');

$app->get('/galeria', function () use ($app) {
	return $app['twig']->render('pages/galeria.twig.html', array());
})->bind('galeria');

$app->get('/costos', function () use ($app) {
	return $app['twig']->render('pages/costos.twig.html', array());
})->bind('costos');

$app->get('/ponentes', function () use ($app) {
	return $app['twig']->render('pages/ponentes.twig.html', array());
})->bind('ponentes');

$app->match('/inscripcion', function (Request $request) use ($app) {
	$db = $app["db"];

	if ($request->getMethod() == "POST") {
		$json = array(
			"status" => false,
			"mensaje" => "Hubo un error al procesar su registro, por favor, intentelo de nuevo."
		);
		$folioRegistro = time();
		$fechaRegistro = new \DateTime('now');

		$result = $db->insert("registros", array(
				"folioRegistro" => $folioRegistro,
				"nombre" => $request->request->get("nombre"),
				"paterno" => $request->request->get("paterno"),
				"materno" => $request->request->get("materno"),
				"email" => $request->request->get("email"),
				"requiereFactura" => $request->request->get("requiereFactura"),
				"razonSocial" => $request->request->get("razonSocial"),
				"rfc" => $request->request->get("rfc"),
				"direccion" => $request->request->get("direccion"),
				"numExt" => $request->request->get("numExt"),
				"numInt" => $request->request->get("numInt"),
				"colonia" => $request->request->get("colonia"),
				"delOMun" => $request->request->get("delOMun"),
				"estado" => $request->request->get("estado"),
				"pais" => $request->request->get("pais"),
				"emailFacturacion" => $request->request->get("emailFacturacion"),
				"fechaRegistro" => $fechaRegistro->format("Y-m-d H:i:s")
			)
		);

		if ($result) {
			$json["status"] = true;
			$json["folioRegistro"] = $folioRegistro;
			$json["email"] = $request->request->get("email");
		}

		return $app->json($json);
	} else {
		$sql = "SELECT * FROM paises WHERE 1 ORDER BY pais_nombreEs ASC";
		$paises = $db->fetchAll($sql);
	}

	return $app['twig']->render('pages/inscripcion.twig.html', array(
			"paises" => $paises
		)
	);
})->bind('inscripcion');

$app->get('/contacto', function () use ($app) {
	return $app['twig']->render('pages/contacto.twig.html', array());
})->bind('contacto');

/*active items */
$app->before(function ($request) use ($app) {
	$app['twig']->addGlobal('active', $request->get("_route"));
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
	if ($app['debug']) {
		return;
	}

	// 404.html, or 40x.html, or 4xx.html, or error.html
	$templates = array(
		'errors/'.$code.'.twig.html',
		'errors/'.substr($code, 0, 2).'x.twig.html',
		'errors/'.substr($code, 0, 1).'xx.twig.html',
		'errors/default.twig.html'
	);

	return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
