<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

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

$app->get('/inscripcion', function () use ($app) {
    return $app['twig']->render('pages/inscripcion.twig.html', array());
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
        'errors/default.twig.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
