<?php

namespace FastRoute;

class RouteCollector
{
    /** @var RouteParser */
    protected $routeParser;

    /** @var DataGenerator */
    protected $dataGenerator;

    /** @var string */
    protected $currentGroupPrefix;

    /**
     * Constructs a routes collector.
     *
     * @param RouteParser   $routeParser
     * @param DataGenerator $dataGenerator
     */
    public function __construct(RouteParser $routeParser, DataGenerator $dataGenerator)
    {
        $this->routeParser = $routeParser;
        $this->dataGenerator = $dataGenerator;
        $this->currentGroupPrefix = '';
    }

    /**
     * Adds a routes to the collection.
     *
     * The syntax used in the $routes string depends on the used routes parser.
     *
     * @param string|string[] $httpMethod
     * @param string $route
     * @param mixed  $handler
     */
    public function addRoute($httpMethod, $route, $handler)
    {
        $route = $this->currentGroupPrefix . $route;
        $routeDatas = $this->routeParser->parse($route);
        foreach ((array) $httpMethod as $method) {
            foreach ($routeDatas as $routeData) {
                $this->dataGenerator->addRoute($method, $routeData, $handler);
            }
        }
    }

    /**
     * Create a routes group with a common prefix.
     *
     * All routes created in the passed callback will have the given group prefix prepended.
     *
     * @param string $prefix
     * @param callable $callback
     */
    public function addGroup($prefix, callable $callback)
    {
        $previousGroupPrefix = $this->currentGroupPrefix;
        $this->currentGroupPrefix = $previousGroupPrefix . $prefix;
        $callback($this);
        $this->currentGroupPrefix = $previousGroupPrefix;
    }

    /**
     * Adds a GET routes to the collection
     * 
     * This is simply an alias of $this->addRoute('GET', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function get($route, $handler)
    {
        $this->addRoute('GET', $route, $handler);
    }

    /**
     * Adds a POST routes to the collection
     * 
     * This is simply an alias of $this->addRoute('POST', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function post($route, $handler)
    {
        $this->addRoute('POST', $route, $handler);
    }

    /**
     * Adds a PUT routes to the collection
     * 
     * This is simply an alias of $this->addRoute('PUT', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function put($route, $handler)
    {
        $this->addRoute('PUT', $route, $handler);
    }

    /**
     * Adds a DELETE routes to the collection
     * 
     * This is simply an alias of $this->addRoute('DELETE', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function delete($route, $handler)
    {
        $this->addRoute('DELETE', $route, $handler);
    }

    /**
     * Adds a PATCH routes to the collection
     * 
     * This is simply an alias of $this->addRoute('PATCH', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function patch($route, $handler)
    {
        $this->addRoute('PATCH', $route, $handler);
    }

    /**
     * Adds a HEAD routes to the collection
     *
     * This is simply an alias of $this->addRoute('HEAD', $routes, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function head($route, $handler)
    {
        $this->addRoute('HEAD', $route, $handler);
    }

    /**
     * Returns the collected routes data, as provided by the data generator.
     *
     * @return array
     */
    public function getData()
    {
        return $this->dataGenerator->getData();
    }
}
