<?php
$loader = require __DIR__.'/vendor/autoload.php';

$loader->add('Twitle', __DIR__.'/src');

$app = new Silex\Application();

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Twitle\Provider\EntityManagerProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/views',
));

$app->mount('/rest/v1', new Twitle\Provider\RestControllerProvider());