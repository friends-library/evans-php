<?php

namespace Evans;

use Closure;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use function FastRoute\{simpleDispatcher};
use Evans\Infrastructure\Providers\ServiceProviderInterface;

class Application extends Container
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        date_default_timezone_set('UTC');
        define('APP_DIR', $basePath);
    }

    /**
     * Register a service provider
     *
     * @param ServiceProviderInterface $provider
     * @return void
     */
    public function register(ServiceProviderInterface $provider): void
    {
        $provider->register($this);
    }

    /**
     * Register app routes
     *
     * @param Closure $callback
     */
    public function routes(Closure $callback): void
    {
        $callback($this);
    }

    /**
     * Register an HTTP GET route
     *
     * @param string $route
     * @param string|Closure $handler
     * @return void
     */
    public function get(string $route, $handler)
    {
        if (is_string($handler)) {
            list($controller, $method) = explode('@', $handler);
            $fqcn = 'Evans\Http\Controllers\\' . $controller;
            $handler = [$fqcn, $method];
        }

        $this->routes[] = [
            'method' => 'GET',
            'route' => $route,
            'handler' => $handler,
        ];
    }

    /**
     * Listen for http requests
     *
     * @return void
     */
    public function listen()
    {
        $dispatcher = $this->getDispatcher();
        $request = Request::createFromGlobals();

        try {
            $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
            switch ($routeInfo[0]) {
                case Dispatcher::NOT_FOUND:
                    throw new NotFoundHttpException();
                case Dispatcher::METHOD_NOT_ALLOWED:
                    throw new MethodNotAllowedHttpException($routeInfo[1]);
                case Dispatcher::FOUND:
                    list($code, $handler, $vars) = $routeInfo;
                    return $this->handleFoundRoute($handler, $vars);
            }
        } catch (NotFoundHttpException $e) {
            header("Location: /not-found");
            exit;
        }
    }

    /**
     * Handle found route
     *
     * @param mixed $handler
     * @param array $vars
     * @return mixed
     */
    protected function handleFoundRoute($handler, $vars = [])
    {
        if (is_array($handler) && class_exists($handler[0])) {
            $handler[0] = $this->make($handler[0]);
        }

        return call_user_func_array($handler, $vars);
    }

    /**
     * Get fast-route dispatcher
     *
     * @return Dispatcher
     */
    protected function getDispatcher(): Dispatcher
    {
        return simpleDispatcher(function (RouteCollector $collector) {
            foreach ($this->routes as $route) {
                $collector->addRoute(
                    $route['method'],
                    $route['route'],
                    $route['handler']
                );
            }
        });
    }
}
