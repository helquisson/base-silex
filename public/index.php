<?php

define('APP_ROOT', dirname(__DIR__));
chdir(APP_ROOT);

use Silex\Application;

//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

require 'vendor/autoload.php';

$app = new Application();

$app['debug'] == true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => 'views'
));

/* exemplo de middleware before */

/*$app->before(function (Request $request) {
    print 'Antes das rotas - ';
});*/

$app->get('/', function () use ($app) {
    return $app['twig']->render('home.twig', array());
});

/* exemplo de middleware after */

/*$app->after(function (Request $request, Response $response) {
    print 'After';
});*/

/* exemplo de middleware finish */

/*$app->finish(function (Request $request, Response $response) {
    print 'depois de response enviado';
});*/

/* rotas */
$app->get('/page/{name}/{id}', function ($name, $id) use ($app) {

    if (is_null($name) || is_null($id)):
        return $app->redirect('/');
    endif;

    return $app['twig']->render('index.twig', array(
        'name' => $name,
        'id' => $id
    ));
})->value('name', NULL)
    ->value('id', NULL);

$app->run();