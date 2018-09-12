<?php
    set_include_path(dirname(__DIR__));
    require("vendor/autoload.php");

    if(isset($_POST['arg0'])){

        $data = $_POST['arg0'];
        $length = strlen($data);
        $result = "";

        for($i = 0; $i < $length; $i++){
            $result .= str_replace("'", '"', $data[$i]);
        }
        $result = str_replace("False", "false", $result);

        echo json_decode($result);
        
        $entryData = array(
            'report' => json_decode($result)
        );

        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
        $socket->connect("tcp://localhost:5555");

        $socket->send(json_encode($entryData));

    }

?>