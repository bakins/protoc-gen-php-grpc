<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/out/GPBMetadata/Helloworld.php';
require_once __DIR__ . '/out/GPBMetadata/Helloworld.php';
require_once __DIR__ . '/out/Helloworld/V1/GreeterClient.php';
require_once __DIR__ . '/out/Helloworld/V1/GreeterServer.php';
require_once __DIR__ . '/out/Helloworld/V1/HelloReply.php';
require_once __DIR__ . '/out/Helloworld/V1/HelloRequest.php';


class Server implements \Helloworld\V1\GreeterService {
    public function SayHello(\Helloworld\V1\HelloRequest $req) : \Helloworld\V1\HelloReply {
        $res =  new \Helloworld\V1\HelloReply;
        $res->setMessage($req->getName());
        return $res;
    }
}

$s = new \Helloworld\V1\GreeterServer(new Server);
$s->serve();
