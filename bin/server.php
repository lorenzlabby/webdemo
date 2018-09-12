<?php
    set_include_path(dirname(__DIR__));
    require("vendor/autoload.php");
    require("src/Config/Pusher.php");

    $loop = React\EventLoop\Factory::create();
    $pusher = new Config\Pusher;

    $context = new React\ZMQ\Context($loop);
    $pull = $context->getSocket(ZMQ::SOCKET_PULL);
    // $pull->bind('tcp://0.0.0.0:5555');

    $pull->on('message', array($pusher, 'onReport'));

    $webSock = new React\Socket\Server('0.0.0.0:0', $loop);

    $webServer = new Ratchet\Server\IoServer(
        new Ratchet\Http\HttpServer(
            new Ratchet\WebSocket\WsServer(
                new Ratchet\Wamp\WampServer(
                    $pusher
                )
            )
        ),
        $webSock
    );

    $loop->run();

?>