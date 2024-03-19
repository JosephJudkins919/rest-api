<?php
class Router {
    protected $routes = [];

    public function get($uri, $handler) {
        $this->routes['GET'][$uri] = $handler;
    }

    public function post($uri, $handler) {
        $this->routes['POST'][$uri] = $handler;
    }

    public function put($uri, $handler) {
        $this->routes['PUT'][$uri] = $handler;
    }

    public function delete($uri, $handler) {
        $this->routes['DELETE'][$uri] = $handler;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');

        if (array_key_exists($uri, $this->routes[$method])) {
            $this->routes[$method][$uri]();
        } else {
            // Handle 404 error
            http_response_code(404);
            echo json_encode(array("message" => "Not Found"));
        }
    }
}
?>
