<?php

$loader = require 'vendor/autoload.php';
$loader->register();


$config = array();
$core = new \vlad\Core($config);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();



$core->map('/', function () {
    return new Response('home');
});

$core->map('/hello/{name}/{age}', function ($name) {

    return new Response('Hello '.$name);
});


$response = $core->handle($request);
$response->send();

/*
$locator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($locator);
$collection = $loader->load('src'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routes.yml');


$route = new Route('/foo', array('controller' => 'MyController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext($_SERVER['REQUEST_URI']);

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
var_dump($matcher);

$config = array();


$core = new User();
 * 
 * /
 */