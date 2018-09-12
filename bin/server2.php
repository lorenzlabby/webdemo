<?php
    set_include_path(dirname(__DIR__));
    require("vendor/autoload.php");
    require("src/Config/Chat.php");

    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use Config\Chat;



    $server = IoServer::factory(
        new Chat(),
        8080
    );

    $server->run();

?>