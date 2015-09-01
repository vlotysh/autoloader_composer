<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vlad;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Description of Core
 *
 * @author vlad
 */
class Core implements HttpKernelInterface {

    protected $routes = array();
    
    public function __construct()
    {
        $this->routes = new RouteCollection();
    }
    
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)     {
        // создаем контекст, используя данные запроса
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $arguments = $attributes;
            unset($arguments['_route']);
            unset($arguments['controller']);
            
            $controller = $attributes['controller'];
            $function = new \ReflectionFunction($controller);

            $response = $function->invokeArgs($arguments);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Не найден!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    public function map($path, $controller) {

        $this->routes->add($path, new Route(
            $path,
            array('controller' => $controller)
        ));
    }

}
