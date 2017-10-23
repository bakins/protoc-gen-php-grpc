<?php
namespace Helloworld\V1;

interface GreeterService {
    public function SayHello(\Helloworld\V1\HelloRequest $req) : \Helloworld\V1\HelloReply;
}

class GreeterServer {
    private $routes;
    private $handler;

    function __construct(GreeterService $implementation) {
        $handler = $implementation;
        $routes = array(
            '/helloworld.v1.Greeter/SayHello' => function($body) {
                $req = new \Helloworld\V1\HelloRequest;
                $req->mergeFromString($body);
                $resp = $handler->SayHello($req);
                return $resp->serializeToString();
            },

            0 => 42
        );
    }

    function Run(string $path) {
        if (is_null($path)) {
            $path = $_SERVER['REQUEST_URI'];
        }
        $f = $routes[$path] ?: null;
        if (is_null($f)) {
            http_response_code(404);
        } else {
            try {
                $body = file_get_contents('php://input');
                $resp = $f($body);
                print($resp);
            } catch (Exception $e) {
                $code = $e->getCode();
                if ($code < 400 || $code > 600) {
                    $code = 500;
                }
                http_response_code($code);
                print($e->getMessage());
            }
        }
    }
}
