<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver'	=> 'pdo_mysql',
		'dbname'	=> 'dermacos_cursos',
		'host'		=> 'localhost', // mysql1016.opentransfer.com
		'user'		=> 'dermacos_r3g1str',
		'password'	=> 'ap[LZI_Bl07q',
		'charset'	=> 'utf8'
		//'unix_socket' => '/var/run/mysqld/mysqld.sock' // '/Applications/MAMP/tmp/mysql/mysql.sock' // /var/run/mysqld/mysqld.sock
	)
));
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

return $app;
