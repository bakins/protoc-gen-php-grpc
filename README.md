# protoc-gen-php-grpc

Experimental PHP server generation for PHP

# Usage

Clone this repo and build it - tested with Go 1.9 - and install the resulting
`protoc-gen-php-grpc` binary into your path

Install `grpc_php_plugin` as described at
https://grpc.io/docs/tutorials/basic/php.html

Copy the resulting binary to `/usr/local/bin/grpc_php_plugin`

Run `./script/protoc` to generate code for the example hello world.

# Status

This is just an idea in code form to be used with https://github.com/bakins/grpc-fastcgi-proxy

It is untested.