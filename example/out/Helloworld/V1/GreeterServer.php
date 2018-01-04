<?php
// GENERATED CODE -- DO NOT EDIT!
namespace Helloworld\V1;

interface GreeterService {
    public function SayHello(\Helloworld\V1\HelloRequest $req) : \Helloworld\V1\HelloReply;
}

class GreeterServer {
    private $routes;
    private $handler;

    function __construct(\Helloworld\V1\GreeterService $implementation) {
        $this->handler = $implementation;
        $this->routes = array(
            '/helloworld.v1.Greeter/SayHello' => function($body) {
                $req = new \Helloworld\V1\HelloRequest;
                $req->mergeFromString($body);
                $resp = $this->handler->SayHello($req);
                return $resp->serializeToString();
            },

            // dummy key to ensure this is a valid array
            0 => 42
        );
    }

    // low-level handler
    function handle(string $path, string $body) : string {
        $f = $this->routes[$path] ?: null;
        if (is_null($f)) {
            throw new \Exception("unknown method", 404);
        } else {
          return $f($body);
        }
    }

    // high-level handler
    function serve() {
        if ( $_SERVER['REQUEST_METHOD'] != "POST" ) {
			http_response_code(400);
			print("invalid HTTP request method");
			exit();
		}
        try {
            $path = $_SERVER['REQUEST_URI'];
            $body = file_get_contents('php://input');
            $resp = $this->handle($path, $body);
            header('Content-Type: application/grpc+proto');
            print($resp);
         } catch (\Exception $e) {
            $code = $e->getCode();
            if ($code < 400 || $code > 600) {
                $code = 500;
            }
            http_response_code($code);
            print($e->getMessage());
        }
    }
}
